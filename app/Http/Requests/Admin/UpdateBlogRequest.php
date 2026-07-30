<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if (empty($this->slug) && !empty($this->title)) {
            $this->merge([
                'slug' => Str::slug($this->title)
            ]);
        }
    }

    public function rules(): array
    {
        $id = $this->route('blog');
        if (is_object($id)) {
            $id = $id->id;
        }

        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $id,
            'category_id' => 'nullable|uuid|exists:blog_categories,id',
            'author_id' => 'nullable|exists:users,id',
            'excerpt' => 'nullable|string|max:1000',
            'short_description' => 'nullable|string',
            'content' => 'required|string',
            'featured_image_media_id' => 'nullable|exists:media_files,id',
            'banner_image_media_id' => 'nullable|exists:media_files,id',
            'status' => 'boolean',
            'featured' => 'boolean',
            'trending' => 'boolean',
            'allow_comments' => 'boolean',
            'sort_order' => 'nullable|integer',
            'published_at' => 'nullable|date',

            // Tags, Gallery, FAQs, SEO, Documents, Related Blogs
            'tags' => 'nullable',
            'gallery' => 'nullable|array',
            'gallery.*' => 'exists:media_files,id',
            'documents' => 'nullable|array',
            'documents.*.media_id' => 'nullable|exists:media_files,id',
            'documents.*.title' => 'nullable|string|max:255',
            'related_blogs' => 'nullable|array',
            'related_blogs.*' => 'exists:blogs,id',
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'nullable|string|max:255',
            'faqs.*.answer' => 'nullable|string',

            'seo.meta_title' => 'nullable|string|max:255',
            'seo.meta_description' => 'nullable|string',
            'seo.meta_keywords' => 'nullable|string|max:255',
            'seo.canonical_url' => 'nullable|url|max:255',
            'seo.og_image_media_id' => 'nullable|exists:media_files,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The blog title is required.',
            'slug.unique' => 'This blog slug is already in use.',
            'content.required' => 'The blog content is required.',
        ];
    }
}
