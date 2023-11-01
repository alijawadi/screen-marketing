<?php

namespace App\Application\Panel\Requests\Playlist;

use Illuminate\Foundation\Http\FormRequest;

class PlaylistStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => [
                "Required"
            ]
        ];
    }
}
