<?php

namespace App\Application\Screen\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveScreenSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'setting' => [
                'required',
                'array'
            ],
        ];
    }
}
