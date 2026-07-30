<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateStatisticsRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        return [
            'years_of_experience' => ['nullable', 'integer', 'min:0'],
            'completed_projects' => ['nullable', 'integer', 'min:0'],
            'happy_clients' => ['nullable', 'integer', 'min:0'],
            'products_delivered' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
