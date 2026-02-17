<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // hanya user login boleh booking
    }

    public function rules(): array
    {
        return [
            'service_id' => [
                'required',
                'exists:services,id'
            ],

            'psycholog_id' => [
                'required',
                'exists:psychologs,id'
            ],

            'session_date' => [
                'required',
                'date',
                'after_or_equal:today'
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
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'Layanan wajib dipilih.',
            'service_id.exists' => 'Layanan tidak valid.',

            'psycholog_id.required' => 'Psikolog wajib dipilih.',
            'psycholog_id.exists' => 'Psikolog tidak valid.',

            'session_date.required' => 'Tanggal sesi wajib diisi.',
            'session_date.after_or_equal' => 'Tidak bisa booking di tanggal yang sudah lewat.',

            'start_time.required' => 'Jam mulai wajib diisi.',
            'start_time.date_format' => 'Format jam mulai harus HH:MM.',

            'end_time.required' => 'Jam selesai wajib diisi.',
            'end_time.date_format' => 'Format jam selesai harus HH:MM.',
            'end_time.after' => 'Jam selesai harus setelah jam mulai.',
        ];
    }
}
