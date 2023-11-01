<?php

namespace App\Application\Panel\Requests\Playlist;

use Illuminate\Foundation\Http\FormRequest;

class SetScreenContentByPlaylistIdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "playlist_id" => [
                "Required"
            ],
            "screen_id" => [
                "Required"
            ]
        ];
    }
}
