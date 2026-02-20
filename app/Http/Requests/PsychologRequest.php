<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PsychologRequest extends FormRequest
{
    /**
     * Authorize
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules
     */
    public function rules(): array
    {
        return [

            // Relasi
            'user_id' => ['required', 'exists:users,id'],
            'wilayah_id' => ['required', 'exists:wilayahs,id'],
            'jenis_psikolog' => ['required', 'exists:types,id'],

            // Data utama
            'fullname' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string'],

            'SIPP' => ['nullable', 'string', 'max:255'],
            'STR' => ['nullable', 'string', 'max:255'],

            'experience_years' => ['required', 'integer', 'min:0'],

            'is_verified' => ['nullable', 'boolean'],

            'verification_status' => [
                'nullable',
                Rule::in(['pending', 'failed', 'complete'])
            ],

            // Topics
            'topics' => ['nullable', 'array'],
            'topics.*' => ['exists:topics,id'],

            'document_legal' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:2048'
            ],
        ];
    }

    /**
     * Custom Messages
     */
    public function messages(): array
    {
        return [

            // Required
            'required' => ':attribute wajib diisi.',
            'exists' => ':attribute tidak valid.',
            'string' => ':attribute harus berupa teks.',
            'integer' => ':attribute harus berupa angka.',
            'array' => ':attribute tidak valid.',
            'boolean' => ':attribute tidak valid.',
            'max' => ':attribute terlalu panjang.',
            'min' => ':attribute tidak boleh kurang dari :min.',

            // Enum
            'verification_status.in' => 'Status verifikasi tidak valid.',

            // Topics
            'topics.*.exists' => 'Topik yang dipilih tidak valid.',

            // Dokumen Legal
            'document_legal.required' => 'Dokumen legal (STR/SIPP) wajib diunggah.',
            'document_legal.file' => 'Input harus berupa file.',
            'document_legal.mimes' => 'Format dokumen harus PDF, JPG, atau PNG.',
            'document_legal.max' => 'Ukuran dokumen tidak boleh lebih dari 2MB.',

        ];
    }

    /**
     * Custom Attribute Names
     */
    public function attributes(): array
    {
        return [
            'user_id' => 'User',
            'wilayah_id' => 'Wilayah',
            'jenis_psikolog' => 'Jenis Psikolog',
            'fullname' => 'Nama Lengkap',
            'about' => 'Tentang',
            'SIPP' => 'Nomor SIPP',
            'STR' => 'Nomor STR',
            'experience_years' => 'Tahun Pengalaman',
            'commision_rate' => 'Komisi',
            'verification_status' => 'Status Verifikasi',
            'topics' => 'Topik',
        ];
    }
}
