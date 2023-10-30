<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetAllMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'folder_id' => [
                'present',
                'nullable',
                'numeric',
                Rule::exists("folders", "id")
            ],
        ];
    }
}
