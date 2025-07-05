<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDokterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'spesialisasi' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:20'],
        ];
    }
}