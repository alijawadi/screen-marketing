<?php

namespace Domain\Screen\Actions;

use App\Domain\Screen\Actions\AuthenticateScreen;
use App\Domain\Screen\Actions\MercurePublish;
use App\Domain\Screen\Actions\RetrievePairingCode;
use App\Domain\Screen\DataTransferObjects\AddScreenDTO;
use App\Domain\Screen\Events\ScreenAddedToOrganizationEvent;
use Domain\Screen\Models\Screen;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Event;
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

        Broadcast::event(new ScreenAddedToOrganizationEvent($topic, $message));
//        ScreenAddedToOrganizationEvent::dispatch($topic, $message);
//        MercurePublish::run($topic, $message);
    }

}
