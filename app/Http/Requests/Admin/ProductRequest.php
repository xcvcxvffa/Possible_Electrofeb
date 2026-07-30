<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
        $id = $this->route('product') ?? null;
        
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'banner_image' => 'required|exists:media_files,id',
            'card_image' => 'nullable|exists:media_files,id',
            'status' => 'boolean',
            'sort_order' => 'nullable|integer',
            
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            
            'features' => 'required|array|min:1',
            'features.*.feature_text' => 'required|string|max:255',
            
            'applications' => 'required|array|min:1',
            'applications.*.application_text' => 'required|string|max:255',
            
            'specifications' => 'required|array|min:1',
            'specifications.*.spec_label' => 'required|string|max:255',
            'specifications.*.spec_value' => 'nullable|string|max:255',
        ];
    }
    
    public function messages(): array
    {
        return [
            'banner_image.required' => 'The banner image is required.',
            'features.required' => 'At least one feature is required.',
            'features.min' => 'At least one feature is required.',
            'applications.required' => 'At least one application is required.',
            'applications.min' => 'At least one application is required.',
            'specifications.required' => 'At least one specification is required.',
            'specifications.min' => 'At least one specification is required.',
        ];
    }
}
