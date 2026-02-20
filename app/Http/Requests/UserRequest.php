<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $userId = $this->route('user');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => $userId
                ? 'nullable|min:6'
                : 'required|min:6',
            'phone' => 'nullable|min:6',
            'is_active' => 'nullable',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'in:laki-laki,perempuan,lainya'],
            'address' => ['nullable', 'string'],
            'avatar' => ['nullable', 'max:2048'],
        ];
    }
}
