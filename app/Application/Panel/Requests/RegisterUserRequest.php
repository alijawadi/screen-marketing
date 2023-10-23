<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ["present", "string"],
            "email" => [
                "Required",
                "email",
                Rule::unique('users')
            ],
            "password" => [
                "Required",
                "string",
                "min:6"
            ],
        ];
    }
}
