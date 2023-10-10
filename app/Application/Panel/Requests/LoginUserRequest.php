<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::exists('users', 'email')/*->whereNotNull('verified_at')*/
            ],
            'password' => [
                'required',
//                'current_password:api'
            ]
        ];
    }
}
