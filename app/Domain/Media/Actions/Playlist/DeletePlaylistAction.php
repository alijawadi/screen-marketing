<?php

namespace App\Domain\Media\Actions\Playlist;

use App\Domain\Media\DataTransferObjects\Playlist\PlaylistAppLayerDTO;
use App\Domain\Media\Models\Playlist;
use Lorisleiva\Actions\Concerns\AsObject;

class DeletePlaylistAction
{
    use AsObject;

    public function handle(PlaylistAppLayerDTO $playlistDTO)
    {
        $playlist = Playlist::query()->findOrFail($playlistDTO->id);
        return $playlist->delete();
    }
}
