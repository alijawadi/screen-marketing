<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFolderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
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
