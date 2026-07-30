<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobLocationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'office_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'status' => 'boolean',
        ];
    }
}
