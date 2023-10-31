<?php

namespace App\Domain\Media\Actions\Playlist;

use App\Domain\Media\DataTransferObjects\PlaylistDTO;
use App\Domain\Media\Models\Playlist;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsObject;

class StorePlaylistAction
{
    use AsObject;

    public function handle(PlaylistDTO $playlistDTO): PlaylistDTO
    {
        $playlist = Playlist::create(
            $playlistDTO->only('name')
                ->additional(['organization_id' => Auth::user()->organization_id])
                ->toArray()
        );
        return PlaylistDTO::from($playlist);
    }
}
