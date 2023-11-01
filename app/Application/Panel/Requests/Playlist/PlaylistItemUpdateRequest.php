<?php

namespace App\Application\Panel\Requests\Playlist;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlaylistItemUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                Rule::exists('playlist_items', 'id'),
            ],
            'order' => 'nullable|integer',
            /**
             * Seconds
             */
            'duration' => 'required|integer',
        ];
    }
}
