<?php

namespace App\Domain\Screen\Actions;

use Domain\Screen\Models\Screen;
use Lorisleiva\Actions\Concerns\AsObject;

class SaveScreenSettingAction
{
    use AsObject;

    public function handle(array $data, Screen $screen)
    {
        $screen->update([
            "setting" => $data["setting"],
        ]);
    }

}
