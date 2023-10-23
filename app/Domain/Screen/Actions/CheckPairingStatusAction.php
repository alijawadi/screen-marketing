<?php

namespace Domain\Screen\Actions;

use App\Domain\Screen\Actions\AuthenticateScreen;
use Domain\Screen\Models\PairingCode;
use Domain\Screen\Models\Screen;
use Lorisleiva\Actions\Concerns\AsAction;

class CheckPairingStatusAction
{
    use AsAction;

    public function handle(string $code)
    {
        /** @var PairingCode $pairingCode */
        $pairingCode = PairingCode::query()->where('code',"=", $code)->first();

        if (!$pairingCode->organization_id){
            return null;
        }

        /** @var Screen $screen */
        $screen = Screen::query()->find($pairingCode->screen_id);

        return AuthenticateScreen::run($screen)->plainTextToken;
    }
}
