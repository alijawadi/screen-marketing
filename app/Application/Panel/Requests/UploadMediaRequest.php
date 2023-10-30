<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UploadMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "file1" => [
                "Required",
                File::types(["image/jpeg", "image/png"])
            ],
            "folder_id" => [
                'present',
                'nullable',
                "numeric",
                Rule::exists("folders", "id"),
            ]
        ];
    }
}
