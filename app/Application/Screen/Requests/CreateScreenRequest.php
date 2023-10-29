<?php

namespace App\Application\Screen\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateScreenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'device_id' => ['required', "string"],
            'tv_data' => ['present', "array"],
        ];
    }
}
