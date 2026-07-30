<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCareerCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:career_categories,id|different:id',
            'description' => 'nullable|string',
            'icon_media_id' => 'nullable|exists:media_files,id',
            'banner_media_id' => 'nullable|exists:media_files,id',
            'status' => 'boolean',
            'sort_order' => 'integer|min:0',
        ];
    }
}
