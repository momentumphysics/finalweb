<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDokterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id', 'unique:dokters,user_id'],
            'spesialisasi' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.unique' => 'User ini sudah terdaftar sebagai dokter.',
        ];
    }
}