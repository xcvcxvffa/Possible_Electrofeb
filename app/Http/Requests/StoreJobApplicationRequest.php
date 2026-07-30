<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Anyone can apply
    }

    public function rules()
    {
        return [
            'career_id' => 'required|exists:careers,id',
            
            // Contact
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            
            // Application File
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
            
            // Extra Info
            'cover_letter' => 'nullable|string|max:5000',
        ];
    }
    
    // We will merge first and last name in the controller, but validate them separately for the frontend form matching.
}
