<?php

namespace App\Application\Panel\Requests\Playlist;

use Illuminate\Foundation\Http\FormRequest;

class SetScreenContentByMediaIdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "media_id" => ["required", "exists:media,id"],
            "screen_id" => ["required", "exists:screens,id"],
        ];
    }
}
