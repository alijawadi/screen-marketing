<?php

namespace App\Domain\Media\Actions\Playlist\PlaylistItem;

use App\Domain\Media\DataTransferObjects\Playlist\PlaylistDTO;
use App\Domain\Media\DataTransferObjects\Playlist\PlaylistUpdateOrderDTO;
use App\Domain\Media\Models\Playlist;
use Lorisleiva\Actions\Concerns\AsObject;

class UpdatePlaylistOrderItemsAction
{
    use AsObject;

    public function handle(PlaylistUpdateOrderDTO $dto): PlaylistDTO
    {
        $playlist = Playlist::query()->findOrFail($dto->playlist_id);

        foreach ($dto->playlist_items as $item) {
            $playlist->items->firstWhere('id', '=', $item['id'])->update(['order' => $item['order']]);
        }

        return PlaylistDTO::from($playlist)->include('items');
    }
}
