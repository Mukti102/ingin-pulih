<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Ubah menjadi true agar request diizinkan
        return auth()->check() && auth()->user()->isPsycholog();
    }

    public function rules(): array
    {
        return [
            'institution_name' => 'required|string|max:255',
            'degree'           => 'required|string|max:255',
            'major'            => 'nullable|string|max:255',
            'graduation_year'  => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
        ];
    }
}