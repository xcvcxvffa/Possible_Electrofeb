<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateWebsiteBrandingRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'logo' => ['nullable', 'file', 'extensions:jpeg,png,jpg,gif,svg,webp,ico', 'max:2048'],
            'dark_logo' => ['nullable', 'file', 'extensions:jpeg,png,jpg,gif,svg,webp,ico', 'max:2048'],
            'footer_logo' => ['nullable', 'file', 'extensions:jpeg,png,jpg,gif,svg,webp,ico', 'max:2048'],
            'favicon' => ['nullable', 'file', 'extensions:jpeg,png,jpg,gif,svg,ico,webp', 'max:512'],
            'apple_touch_icon' => ['nullable', 'file', 'extensions:jpeg,png,jpg,gif,svg,ico,webp', 'max:512'],
            'company_profile_pdf' => ['nullable', 'file', 'extensions:pdf', 'max:10240'],
        ];
    }
}

