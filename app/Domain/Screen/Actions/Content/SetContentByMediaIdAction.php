<?php

namespace App\Domain\Screen\Actions\Content;

use App\Domain\Media\DataTransferObjects\MediaDTO;
use App\Domain\Media\Models\Media;
use App\Domain\Screen\DataTransferObjects\ScreenDTO;
use App\Domain\Screen\DataTransferObjects\SetContentByMediaDTO;
use App\Domain\Screen\Events\SetScreenContentByMediaIdEvent;
use App\Domain\Screen\Events\SetScreenContentByPlaylistEvent;
use Domain\Screen\Models\Screen;
use Illuminate\Support\Facades\Broadcast;
use Lorisleiva\Actions\Concerns\AsObject;

class SetContentByMediaIdAction
{
    use AsObject;

    public function handle(SetContentByMediaDTO $dto): ScreenDTO
    {
        $screen = Screen::query()->findOrFail($dto->screen_id);
        $media = Media::query()->findOrFail($dto->media_id);
        $mediaDTO = MediaDTO::from($media);
        Broadcast::event(new SetScreenContentByMediaIdEvent($screen->broadcast_chanel, $mediaDTO->toArray()));
        return ScreenDTO::from($screen);
    }
}
