<?php

namespace App\Domain\Screen\Actions\Content;

use App\Domain\Media\DataTransferObjects\PlaylistDTO;
use App\Domain\Media\Models\Playlist;
use App\Domain\Screen\DataTransferObjects\ScreenDTO;
use App\Domain\Screen\DataTransferObjects\SetContentByPlaylistDTO;
use App\Domain\Screen\Events\SetScreenContentByPlaylistEvent;
use Domain\Screen\Models\Screen;
use Illuminate\Support\Facades\Broadcast;
use Lorisleiva\Actions\Concerns\AsObject;

class SetContentByPlaylistIdAction
{
    use AsObject;

    public function handle(SetContentByPlaylistDTO $dto): ScreenDTO
    {
        $screen = Screen::query()->findOrFail($dto->screen_id);
        $playlist = Playlist::query()->findOrFail($dto->playlist_id);
        $playlistDTO = PlaylistDTO::from($playlist);
        Broadcast::event(new SetScreenContentByPlaylistEvent($screen->broadcast_chanel, $playlistDTO->toArray()));
        return ScreenDTO::from($screen);
    }
}
