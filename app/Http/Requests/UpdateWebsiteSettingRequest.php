<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateWebsiteSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
    *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_email' => ['nullable', 'email', 'max:255'],
            'company_phone' => ['nullable', 'string', 'max:50'],
            'company_address' => ['nullable', 'string'],
            'logo' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp,ico', 'max:2048'],
            'dark_logo' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp,ico', 'max:2048'],
            'favicon' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,ico,webp', 'max:1024'],
            'company_profile_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'years_of_experience' => ['nullable', 'integer', 'min:0'],
            'completed_projects' => ['nullable', 'integer', 'min:0'],
            'happy_clients' => ['nullable', 'integer', 'min:0'],
            'products_delivered' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
