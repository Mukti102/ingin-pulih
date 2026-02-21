<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'booking_id' => [
                'required',
                'exists:bookings,id'
            ],
            'psycholog_id' => [
                'required',
                'exists:psychologs,id'
            ],
            'rating' => [
                'required',
            ],
            'comment' => [
                'nullable',
                'string',
                'max:500'
            ],
            'published' => [
                'boolean',
                'nullable'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'booking_id.required' => 'Booking ID wajib diisi.',
            'booking_id.exists' => 'Booking ID tidak valid.',

            'psycholog_id.required' => 'Psikolog ID wajib diisi.',
            'psycholog_id.exists' => 'Psikolog ID tidak valid.',

            'user_id.required' => 'User ID wajib diisi.',
            'user_id.exists' => 'User ID tidak valid.',

            'rating.required' => 'Rating wajib diisi.',
            'rating.integer' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal 1.',
            'rating.max' => 'Rating maksimal 5.',

            'comment.string' => 'Komentar harus berupa teks.',
            'comment.max' => 'Komentar maksimal 500 karakter.',

            'published.boolean' => 'Published harus berupa nilai boolean.'
        ];
    }
}
