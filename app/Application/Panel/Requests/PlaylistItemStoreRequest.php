<?php

namespace App\Application\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaylistItemStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'playlist_id' => 'required|exists:playlists,id',
            'media_id' => 'required|exists:media,id',
        ];
    }
}
