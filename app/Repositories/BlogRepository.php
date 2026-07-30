<?php

namespace App\Repositories;

use App\Models\Blog;

class BlogRepository
{
    public function getAllBlogs($filters = [])
    {
        $query = Blog::with(['category', 'author', 'featuredMedia', 'bannerMedia']);

        if (isset($filters['status']) && $filters['status'] !== '') {
            $query->where('status', $filters['status']);
        }
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        if (!empty($filters['author_id'])) {
            $query->where('author_id', $filters['author_id']);
        }
        if (isset($filters['featured']) && $filters['featured'] !== '') {
            $query->where('featured', $filters['featured']);
        }
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('sort_order', 'asc')->latest()->get();
    }

    public function getBlogById($id)
    {
        return Blog::with([
            'category',
            'author',
            'featuredMedia',
            'bannerMedia',
            'gallery.media',
            'documents.media',
            'relatedBlogs',
            'seo.ogImageMedia',
            'faqs',
            'slugHistory',
        ])->findOrFail($id);
    }

    public function getBlogBySlug($slug)
    {
        return Blog::with([
            'category',
            'author',
            'featuredMedia',
            'bannerMedia',
            'gallery.media',
            'documents.media',
            'relatedBlogs',
            'seo.ogImageMedia',
            'faqs',
        ])->where('slug', $slug)->where('status', true)->firstOrFail();
    }

    public function getTrashedBlogs()
    {
        return Blog::onlyTrashed()->with(['category', 'author'])->latest('deleted_at')->get();
    }

    public function createBlog(array $data)
    {
        return Blog::create($data);
    }

    public function updateBlog($id, array $data)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($data);
        return $blog;
    }

    public function deleteBlog($id)
    {
        $blog = Blog::findOrFail($id);
        return $blog->delete();
    }

    public function restoreBlog($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        return $blog->restore();
    }

    public function forceDeleteBlog($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        return $blog->forceDelete();
    }

    public function bulkDelete(array $ids)
    {
        return Blog::whereIn('id', $ids)->delete();
    }

    public function bulkRestore(array $ids)
    {
        return Blog::onlyTrashed()->whereIn('id', $ids)->restore();
    }
}
