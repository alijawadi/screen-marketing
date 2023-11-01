<?php

namespace App\Domain\Media\Actions\Playlist\PlaylistItem;

use App\Domain\Media\DataTransferObjects\Playlist\AddMediaToPlaylistDTO;
use App\Domain\Media\DataTransferObjects\Playlist\PlaylistDTO;
use App\Domain\Media\Models\Media;
use App\Domain\Media\Models\Playlist;
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
            'duration' => $addMediaToPlaylistDTO->duration,
        ]);

        return PlaylistDTO::from($playlist)->include('items');
    }
}
