<?php

namespace App\Domain\Media\Actions\Playlist;

use App\Domain\Media\DataTransferObjects\PlaylistAppLayerDTO;
use App\Domain\Media\DataTransferObjects\PlaylistDTO;
use App\Domain\Media\Models\Playlist;
use Lorisleiva\Actions\Concerns\AsObject;

class UpdatePlaylistAction
{
    use AsObject;

    public function handle(PlaylistAppLayerDTO $playlistDTO): PlaylistDTO
    {
        $playlist = Playlist::query()->findOrFail($playlistDTO->id);
        $playlist->update($playlistDTO->toArray());
        return PlaylistDTO::fromModel($playlist);
    }
}
