<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class AddTemplateFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "template_id" => [
                "required",
                "string"
            ],
            "template_file" => [
                "required",
                File::types(["image/jpeg", "image/png"])
            ],
        ];
    }
}
