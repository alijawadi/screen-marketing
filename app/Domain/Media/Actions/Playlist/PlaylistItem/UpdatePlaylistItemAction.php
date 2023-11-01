<?php

namespace App\Domain\Media\Actions\Playlist\PlaylistItem;

use App\Domain\Media\DataTransferObjects\Playlist\PlaylistDTO;
use App\Domain\Media\DataTransferObjects\Playlist\UpdatePlaylistItemDTO;
use App\Domain\Media\Models\PlaylistItem;
use Lorisleiva\Actions\Concerns\AsObject;

class UpdatePlaylistItemAction
{
    use AsObject;

    public function handle(UpdatePlaylistItemDTO $updatePlaylistItemDTO): PlaylistDTO
    {
        $playlistItem = PlaylistItem::findOrFail($updatePlaylistItemDTO->id);
        $playlistItem->update([
            'order' => $updatePlaylistItemDTO->order ?? $playlistItem->order,
            'duration' => $updatePlaylistItemDTO->duration ?? $playlistItem->duration,
        ]);

        return PlaylistDTO::from($playlistItem->playlist)->include('items');
    }
}
