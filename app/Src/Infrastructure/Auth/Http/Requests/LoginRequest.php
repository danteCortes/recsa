<?php

namespace App\Src\Infrastructure\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            // Add your messages here
        ];
    }

    public function attributes(): array
    {
        return [
            // Add your attributes here
        ];
    }
}
