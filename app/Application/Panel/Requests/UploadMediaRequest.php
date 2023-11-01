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
        //please provide laravel validation rule to upload only images and videos and text files
        return [
            "file" => [
                "Required",
                File::types(["image/jpeg", "image/png", "image/gif", "video/mp4", "application/pdf"])
            ],
            "folder_id" => [
                'nullable',
                Rule::exists("folders", "id"),
            ]
        ];
    }
}
