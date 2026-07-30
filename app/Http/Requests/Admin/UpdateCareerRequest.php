<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCareerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('career');
        
        return [
            // General
            'title' => 'required|string|max:255',
            'career_category_id' => 'nullable|exists:career_categories,id', // Legacy support
            'category_name' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:departments,id', // Legacy support
            'department_name' => 'nullable|string|max:255',
            'job_location_id' => 'nullable|exists:job_locations,id', // Legacy support
            'location_name' => 'nullable|string|max:255',
            'job_type_id' => 'nullable|exists:job_types,id', // Legacy support
            'job_type_name' => 'nullable|string|max:255',
            'job_code' => 'nullable|string|max:100|unique:careers,job_code,' . $id,
            
            // Details
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            
            // Job Details Tab
            'salary_type' => 'required|in:fixed,range,negotiable,not_disclosed',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'currency' => 'nullable|string|max:10',
            'experience' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'vacancies' => 'nullable|integer|min:1',
            'application_deadline' => 'nullable|date',
            
            // Flags
            'featured' => 'boolean',
            'urgent' => 'boolean',
            'status' => 'boolean',
            
            // Media
            'banner_media_id' => 'nullable|exists:media_files,id',
            'brochure_media_id' => 'nullable|exists:media_files,id',
            
            // Dynamic Relations
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'nullable|string',
            
            'requirements' => 'nullable|array',
            'requirements.*' => 'nullable|string',
            
            'benefits' => 'nullable|array',
            'benefits.*' => 'nullable|string',
            
            'skills' => 'nullable|array',
            'skills.*' => 'nullable|exists:skills,id',
            
            'faqs' => 'nullable|array',
            'faqs.*.question' => 'nullable|string',
            'faqs.*.answer' => 'nullable|string',
            
            'documents' => 'nullable|array',
            'documents.*.media_id' => 'nullable|exists:media_files,id',
            'documents.*.title' => 'nullable|string',
            'documents.*.type' => 'nullable|string',
            
            // SEO
            'seo.meta_title' => 'nullable|string|max:255',
            'seo.meta_description' => 'nullable|string',
            'seo.meta_keywords' => 'nullable|string',
            'seo.og_image_media_id' => 'nullable|exists:media_files,id',
        ];
    }
}
