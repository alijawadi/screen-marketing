<?php

namespace App\Domain\Screen\Actions;

use Domain\Screen\Models\Screen;
use Lorisleiva\Actions\Concerns\AsObject;

class SaveScreenDataAction
{
    use AsObject;

    public function handle(array $data, Screen $screen)
    {
        $screen->update([
            "tv_data" => $data["tv_data"],
        ]);
    }

}
