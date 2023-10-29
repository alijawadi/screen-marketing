<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateFolderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_id' => [
                'nullable',
                'numeric',
                Rule::exists("folders", "id")
            ],
            'name' => [
                'required',
                'string',
                "regex:/^[A-Za-z0-9]+$/"
            ],
        ];
    }
}
