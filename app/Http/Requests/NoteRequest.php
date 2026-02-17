<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'notes'           => ['required', 'string', 'min:10'],
            'document_path' => ['nullable', 'max:2048']
        ];
    }

    /**
     * Custom attributes untuk pesan error yang lebih user-friendly
     */
    public function attributes(): array
    {
        return [
            'notes'           => 'Catatan Sesi',
            'document_path' => 'document'
        ];
    }

    public function messages(): array
    {
        return [


            'notes.required'           => ':attribute wajib diisi.',
            'notes.min'                => ':attribute terlalu singkat, minimal harus :min karakter.',

            'document_path.file'       => ':attribute harus berupa file valid.',
            'document_path.mimes'      => ':attribute harus berformat PDF, JPG, atau PNG.',
            'document_path.max'        => 'Ukuran :attribute maksimal adalah 2MB.',
        ];
    }
}
