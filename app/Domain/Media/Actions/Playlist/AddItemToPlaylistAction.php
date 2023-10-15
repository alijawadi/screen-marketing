<?php

namespace App\Domain\Media\Actions\Playlist;

use App\Domain\Media\DataTransferObjects\PlaylistDTO;
use App\Domain\Media\Models\Playlist;
use App\Domain\Media\Models\PlaylistItem;
use Lorisleiva\Actions\Concerns\AsObject;

class AddItemToPlaylistAction
{
    use AsObject;

    public function handle($item): PlaylistDTO
    {

        $item = PlaylistItem::create($item);
        $playlist = Playlist::findOrFail('id');

        //todo associate PlaylistItem to Playlist

        return PlaylistDTO::from($playlist);
    }
}
