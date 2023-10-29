<?php

namespace App\Domain\Screen\Actions;

use App\Domain\Media\DataTransferObjects\MediaDTO;
use App\Domain\Media\Models\Media;
use App\Domain\Screen\DataTransferObjects\ScreenDTO;
use App\Domain\Screen\DataTransferObjects\SetContentDTO;
use App\Domain\Screen\Events\SetScreenContentByMediaIdEvent;
use Domain\Screen\Models\Screen;
use Illuminate\Support\Facades\Broadcast;
use Lorisleiva\Actions\Concerns\AsObject;

class SetContentByMediaIdAction
{
    use AsObject;

    public function handle(SetContentDTO $dto)
    {
        $screen = Screen::query()->findOrFail($dto->screenId);
        $media = Media::query()->findOrFail($dto->mediaId);

        $mediaDTO = MediaDTO::from($media);
        Broadcast::event(new SetScreenContentByMediaIdEvent($screen->broadcast_chanel, $mediaDTO));

        return ScreenDTO::from($screen);
    }
}
