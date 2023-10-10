<?php

namespace Domain\Screen\Actions;

use App\Domain\Screen\Actions\AuthenticateScreen;
use Domain\Screen\Models\PairingCode;
use Domain\Screen\Models\Screen;
use Lorisleiva\Actions\Concerns\AsAction;

class CheckPairingStatusAction
{
    use AsAction;

    public function handle(string $pairingCode)
    {
        $pairingCode = PairingCode::where('code', $pairingCode)->firstOrFail();
        $screen = Screen::findOrFail($pairingCode->screen_id);
        return AuthenticateScreen::run($screen)->plainTextToken;
    }
}
