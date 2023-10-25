<?php

namespace App\Domain\Screen\Actions;

use Domain\Screen\Models\Screen;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsObject;

class PanelScreenList
{
    use AsObject;

    public function handle(int $organization_id): Collection
    {
        $screens = Screen::query()
            ->where("organization_id", "=", $organization_id)
            ->get();

        return $screens;
    }
}
