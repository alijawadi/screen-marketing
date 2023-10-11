<?php

namespace App\Domain\Screen\Actions;

use App\Domain\Screen\DataTransferObjects\ScreenDTO;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsObject;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class PanelScreenList
{
    use AsObject;

    public function handle(): DataCollection|CursorPaginatedDataCollection|PaginatedDataCollection
    {
        //todo get the Org id from app layer
        $screens = Auth::user()->organization->screens();

        return ScreenDTO::collection($screens->paginate());
    }
}
