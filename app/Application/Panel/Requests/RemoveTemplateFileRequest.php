<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveTemplateFileRequest extends FormRequest
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
                "string"
            ],
        ];
    }
}
