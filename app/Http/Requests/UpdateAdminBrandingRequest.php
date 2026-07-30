<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateAdminBrandingRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'admin_logo' => ['nullable', 'file', 'extensions:jpeg,png,jpg,gif,svg,webp,ico', 'max:2048'],
            'admin_mini_logo' => ['nullable', 'file', 'extensions:jpeg,png,jpg,gif,svg,webp,ico', 'max:2048'],
            'admin_login_logo' => ['nullable', 'file', 'extensions:jpeg,png,jpg,gif,svg,webp,ico', 'max:2048'],
            'admin_login_background' => ['nullable', 'file', 'extensions:jpeg,png,jpg,gif,svg,webp', 'max:5120'],
            'admin_favicon' => ['nullable', 'file', 'extensions:jpeg,png,jpg,gif,svg,ico,webp', 'max:512'],
        ];
    }
}

