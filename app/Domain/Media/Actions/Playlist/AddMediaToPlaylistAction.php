<?php

namespace App\Domain\Media\Actions\Playlist;

use App\Domain\Media\DataTransferObjects\AddMediaToPlaylistDTO;
use App\Domain\Media\DataTransferObjects\PlaylistDTO;
use App\Domain\Media\Models\Media;
use App\Domain\Media\Models\Playlist;
use App\Domain\Media\Models\PlaylistItem;
use Lorisleiva\Actions\Concerns\AsObject;

class AddMediaToPlaylistAction
{
    use AsObject;

    public function handle(AddMediaToPlaylistDTO $addMediaToPlaylistDTO): PlaylistDTO
    {
        $playlist = Playlist::findOrFail($addMediaToPlaylistDTO->playlist_id);
        $media = Media::query()->findOrFail($addMediaToPlaylistDTO->media_id);

        $media->playlistItem()->create([
            'playlist_id' => $playlist->id,
            'order' => $addMediaToPlaylistDTO->order,
        ]);

        return PlaylistDTO::from($playlist);
    }
}
