<?php

namespace App\Services;

use App\Repositories\BlogRepository;

use App\Models\BlogSlugHistory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogService
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function getAllBlogs($filters = [])
    {
        return $this->blogRepository->getAllBlogs($filters);
    }

    public function getBlogById($id)
    {
        return $this->blogRepository->getBlogById($id);
    }

    public function getBlogBySlug($slug)
    {
        return $this->blogRepository->getBlogBySlug($slug);
    }

    public function getTrashedBlogs()
    {
        return $this->blogRepository->getTrashedBlogs();
    }

    public function createBlog(array $data)
    {
        DB::beginTransaction();
        try {
            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            // Auto calculate reading time
            $data['reading_time'] = $this->calculateReadingTime($data['content'] ?? '');

            if (empty($data['author_id']) && Auth::check()) {
                $data['author_id'] = Auth::id();
            }

            if (empty($data['published_at']) && !empty($data['status'])) {
                $data['published_at'] = now();
            }

            $blog = $this->blogRepository->createBlog($data);

            $this->syncRelations($blog, $data);

            DB::commit();
            return $blog;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateBlog($id, array $data)
    {
        DB::beginTransaction();
        try {
            $blog = $this->blogRepository->getBlogById($id);
            $oldSlug = $blog->slug;

            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title']);
            }

            // Record slug history if changed
            if ($oldSlug !== $data['slug']) {
                BlogSlugHistory::create([
                    'blog_id' => $blog->id,
                    'old_slug' => $oldSlug,
                ]);
            }

            // Auto calculate reading time
            if (isset($data['content'])) {
                $data['reading_time'] = $this->calculateReadingTime($data['content']);
            }

            if (empty($blog->published_at) && !empty($data['status'])) {
                $data['published_at'] = now();
            }

            $blog = $this->blogRepository->updateBlog($id, $data);

            $this->syncRelations($blog, $data);

            DB::commit();
            return $blog;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteBlog($id)
    {
        return $this->blogRepository->deleteBlog($id);
    }

    public function restoreBlog($id)
    {
        return $this->blogRepository->restoreBlog($id);
    }

    public function forceDeleteBlog($id)
    {
        return $this->blogRepository->forceDeleteBlog($id);
    }

    public function bulkDelete(array $ids)
    {
        return $this->blogRepository->bulkDelete($ids);
    }

    public function bulkRestore(array $ids)
    {
        return $this->blogRepository->bulkRestore($ids);
    }

    protected function calculateReadingTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $minutes = ceil($wordCount / 200);
        return max(1, $minutes);
    }

    protected function syncRelations($blog, array $data)
    {


        // 2. Sync Gallery
        if (isset($data['gallery'])) {
            $blog->gallery()->delete();
            $sort = 0;
            foreach ($data['gallery'] as $mediaId) {
                if (!empty($mediaId)) {
                    $blog->gallery()->create([
                        'media_id' => $mediaId,
                        'sort_order' => $sort++,
                    ]);
                }
            }
        }

        // 3. Sync Documents
        if (isset($data['documents'])) {
            $blog->documents()->delete();
            $sort = 0;
            foreach ($data['documents'] as $doc) {
                if (!empty($doc['media_id'])) {
                    $blog->documents()->create([
                        'media_id' => $doc['media_id'],
                        'title' => $doc['title'] ?? null,
                        'document_type' => $doc['document_type'] ?? null,
                        'sort_order' => $sort++,
                    ]);
                }
            }
        }

        // 4. Sync Related Blogs
        if (isset($data['related_blogs']) && is_array($data['related_blogs'])) {
            $blog->relatedBlogs()->sync($data['related_blogs']);
        }

        // 5. Sync SEO & generate JSON-LD Article Schema
        if (isset($data['seo']) && is_array($data['seo'])) {
            $metaTitle = $data['seo']['meta_title'] ?? $blog->title;
            $metaDesc = $data['seo']['meta_description'] ?? $blog->excerpt;
            $schemaJson = [
                '@context' => 'https://schema.org',
                '@type' => 'Article',
                'headline' => $metaTitle,
                'description' => $metaDesc,
                'datePublished' => $blog->published_at ? $blog->published_at->toIso8601String() : now()->toIso8601String(),
                'dateModified' => $blog->updated_at ? $blog->updated_at->toIso8601String() : now()->toIso8601String(),
            ];

            $blog->seo()->updateOrCreate(
                ['blog_id' => $blog->id],
                [
                    'meta_title' => $metaTitle,
                    'meta_description' => $metaDesc,
                    'meta_keywords' => $data['seo']['meta_keywords'] ?? null,
                    'canonical_url' => $data['seo']['canonical_url'] ?? null,
                    'og_image_media_id' => $data['seo']['og_image_media_id'] ?? $blog->featured_image_media_id,
                    'schema_json' => $schemaJson,
                ]
            );
        }

        // 6. Sync FAQs
        if (isset($data['faqs'])) {
            $blog->faqs()->delete();
            $sort = 0;
            foreach ($data['faqs'] as $faq) {
                if (!empty($faq['question']) && !empty($faq['answer'])) {
                    $blog->faqs()->create([
                        'question' => $faq['question'],
                        'answer' => $faq['answer'],
                        'sort_order' => $sort++,
                        'status' => true,
                    ]);
                }
            }
        }
    }
}
