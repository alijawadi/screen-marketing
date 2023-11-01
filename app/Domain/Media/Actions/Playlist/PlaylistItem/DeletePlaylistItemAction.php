<?php

namespace App\Domain\Media\Actions\Playlist\PlaylistItem;

use App\Domain\Media\DataTransferObjects\Playlist\UpdatePlaylistItemDTO;
use App\Domain\Media\Models\PlaylistItem;
use Lorisleiva\Actions\Concerns\AsObject;

class DeletePlaylistItemAction
{
    use AsObject;

    public function handle(UpdatePlaylistItemDTO $dto)
    {
        return PlaylistItem::query()->findOrFail($dto->id)->delete();
    }
}
