<?php

namespace App\Application\Panel\Requests\Playlist;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlaylistItemOrderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'playlist_id' => 'required|exists:playlists,id',
            'playlist_items' => 'required|array',
            'playlist_items.*.order' => 'required|integer',
            'playlist_items.*.id' => [
                'required',
                'integer',
                Rule::exists('playlist_items')->whereNull('deleted_at'),
            ],
        ];
    }
}
