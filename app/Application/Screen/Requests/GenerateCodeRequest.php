<?php

namespace App\Application\Screen\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tv_data' => ['present', "array"],
        ];
    }
}
