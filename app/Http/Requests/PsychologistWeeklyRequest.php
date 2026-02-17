<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PsychologistWeeklyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isPsycholog();
    }

    public function rules(): array
    {
        return [
            'day_of_week' => [
                'required',
                Rule::in([
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                    'sunday'
                ]),
            ],

            'start_time' => [
                'required',
                // 'date_format:H:i'
            ],

            'end_time' => [
                'required',
                // 'date_format:H:i',
                'after:start_time'
            ],

            'is_active' => [
                'nullable',
                'boolean'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'day_of_week.required' => 'Hari wajib dipilih.',
            'day_of_week.in' => 'Hari tidak valid.',

            'start_time.required' => 'Jam mulai wajib diisi.',
            'start_time.date_format' => 'Format jam mulai harus HH:MM.',

            'end_time.required' => 'Jam selesai wajib diisi.',
            'end_time.date_format' => 'Format jam selesai harus HH:MM.',
            'end_time.after' => 'Jam selesai harus setelah jam mulai.',
        ];
    }
}
