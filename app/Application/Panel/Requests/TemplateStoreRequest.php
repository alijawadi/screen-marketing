<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemplateStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
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
