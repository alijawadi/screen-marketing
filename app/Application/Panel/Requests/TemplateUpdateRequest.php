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
            "id" => [
                "required",
                Rule::exists('templates', 'id')->whereNull('deleted_at')
            ],
            "file" => [
                "nullable",
                "image64",
            ],
            "data" => [
                "nullable",
                "string"
            ]
        ];
    }
}
