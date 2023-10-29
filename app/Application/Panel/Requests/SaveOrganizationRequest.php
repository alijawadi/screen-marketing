<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => [
                'nullable',
                'string',
            ],
            'name' => [
                'nullable',
                'string',
            ],
            'phone' => [
                'nullable',
                'string',
            ],
            'country_code' => [
                'nullable',
                'string',
            ],
            'country' => [
                'nullable',
                'string',
            ],
            'city' => [
                'nullable',
                'string',
            ],
            'street' => [
                'nullable',
                'string',
            ],
            'postcode' => [
                'nullable',
                'string',
            ],
            'lat' => [
                'required_with:lon',
                'string',
            ],
            'lon' => [
                'required_with:lat',
                'string',
            ],
        ];
    }
}
