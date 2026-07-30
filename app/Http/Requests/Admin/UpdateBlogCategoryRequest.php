<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateBlogCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if (empty($this->slug) && !empty($this->name)) {
            $this->merge([
                'slug' => Str::slug($this->name)
            ]);
        }
    }

    public function rules(): array
    {
        $id = $this->route('blog_category');
        if (is_object($id)) {
            $id = $id->id;
        }

        return [
            'parent_id' => 'nullable|uuid|exists:blog_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_categories,slug,' . $id,
            'description' => 'nullable|string',
            'image_media_id' => 'nullable|exists:media_files,id',
            'sort_order' => 'nullable|integer',
            'status' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The category name is required.',
            'slug.unique' => 'This category slug is already in use.',
        ];
    }
}
