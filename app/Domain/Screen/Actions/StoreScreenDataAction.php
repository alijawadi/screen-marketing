<?php

namespace App\Domain\Screen\Actions;

use App\Domain\Screen\DataTransferObjects\ScreenDTO;
use Domain\Screen\Models\Screen;
use Lorisleiva\Actions\Concerns\AsObject;

class StoreScreenDataAction
{
    use AsObject;

    public function handle(ScreenDTO $screenDTO): ScreenDTO
    {
        $screen = Screen::findOrFail($screenDTO->id);
        $screen->update($screenDTO->except('id')->toArray());
        return ScreenDTO::from($screen);
    }
}
