<?php

namespace App\Domain\Media\Actions\Playlist;

use App\Domain\Media\DataTransferObjects\Playlist\PlaylistAppLayerDTO;
use App\Domain\Media\DataTransferObjects\Playlist\PlaylistDTO;
use App\Domain\Media\Models\Playlist;
use Lorisleiva\Actions\Concerns\AsObject;

class RetrievePlaylistAction
{
    use AsObject;

    public function handle(PlaylistAppLayerDTO $playlistDTO): PlaylistDTO
    {
        return PlaylistDTO::from(Playlist::findOrFail($playlistDTO->id))->include('items');
    }
}
