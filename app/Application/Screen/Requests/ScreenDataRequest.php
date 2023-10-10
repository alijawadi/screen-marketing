<?php

namespace App\Application\Screen\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScreenDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'device_id' => [
                'required'
            ],
            'tv_data' => [
                'required'
            ],

        ];
    }
}
