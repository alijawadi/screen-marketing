<?php

namespace App\Domain\Media\Actions\Playlist;

use App\Domain\Media\DataTransferObjects\PlaylistDTO;
use App\Domain\Media\Models\Playlist;
use Lorisleiva\Actions\Concerns\AsObject;

class StorePlaylistAction
{
    use AsObject;

    public function handle(PlaylistDTO $playlistDTO): PlaylistDTO
    {
        $playlist = Playlist::create($playlistDTO->only('name')->toArray());
        return PlaylistDTO::from($playlist);
    }
}
