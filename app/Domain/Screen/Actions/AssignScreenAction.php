<?php

namespace Domain\Screen\Actions;

use App\Domain\Screen\Actions\AuthenticateScreen;
use App\Domain\Screen\Actions\MercurePublish;
use App\Domain\Screen\Actions\RetrievePairingCode;
use App\Domain\Screen\DataTransferObjects\AddScreenDTO;
use Domain\Screen\Models\Screen;
use Lorisleiva\Actions\Concerns\AsAction;

class AssignScreenAction
{
    use AsAction;

    public function handle(AddScreenDTO $addScreenDTO)
    {
        $pairingCode = RetrievePairingCode::run($addScreenDTO->code);

        // Assign Organization to Screen
        $screen = Screen::findOrFail($pairingCode->screen_id);
        $screen->update(["organization_id" => $addScreenDTO->organization_id]);
        $pairingCode->update(['screen_id' => $screen->id]);

        // Publish message to the ScreenApp

        $topic = $pairingCode->code;
        $message = json_encode(['token' => AuthenticateScreen::run($screen)]);
        MercurePublish::run($topic, $message);
    }

}
