<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TemplateUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "templates" => [
                "nullable",
                "array"
            ],
            "store" => [
                "nullable",
                "array"
            ]
        ];
    }
}
