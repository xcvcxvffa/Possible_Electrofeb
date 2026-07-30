<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateContactInfoRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'office_address' => ['nullable', 'string'],
            'office_email' => ['nullable', 'email', 'max:255'],
            'office_phone' => ['nullable', 'string', 'max:50'],
            'working_hours' => ['nullable', 'string', 'max:255'],
        ];
    }
}
