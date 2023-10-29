<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MediaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "file" => [
                "Required",
                "image64",
            ],
            "folder_id" => [
                "integer",
                Rule::exists('folders', 'id')->whereNull('deleted_at'),
            ]
        ];
    }
}
