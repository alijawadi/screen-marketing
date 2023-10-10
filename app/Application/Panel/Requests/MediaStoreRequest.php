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
                "file",
            ],
            "folder_id" => [
//                Rule::exists('folders', 'id')->whereNull('deleted_at'),
                "nullable"
            ]
        ];
    }
}
