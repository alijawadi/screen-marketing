<?php

namespace Domain\Screen\Actions;

use App\Domain\Screen\Actions\AuthenticateScreen;
use App\Domain\Screen\DataTransferObjects\AddScreenDTO;
use App\Domain\Screen\Events\ScreenAddedToOrganizationEvent;
use Domain\Screen\Models\PairingCode;
use Domain\Screen\Models\Screen;
use Illuminate\Support\Facades\Broadcast;
use Lorisleiva\Actions\Concerns\AsAction;

class AssignScreenAction
{
    use AsAction;

    public function handle(AddScreenDTO $addScreenDTO)
    {
        /** @var PairingCode $pairingCode */
        $pairingCode = PairingCode::query()->where('code', $addScreenDTO->code)->first();

        /** @var Screen $screen */
        $screen = Screen::query()->find($pairingCode->screen_id);

        $screen->update([
            "organization_id" => $addScreenDTO->organization_id
        ]);

        $pairingCode->update([
            "organization_id" => $addScreenDTO->organization_id
        ]);

        $topic = $pairingCode->code;
        $message = json_encode(['token' => AuthenticateScreen::run($screen)]);

        Broadcast::event(new ScreenAddedToOrganizationEvent($pairingCode->code));
//        ScreenAddedToOrganizationEvent::dispatch($topic, $message);
//        MercurePublish::run($topic, $message);
    }

}
