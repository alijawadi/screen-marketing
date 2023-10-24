<?php

namespace Domain\Screen\Actions;

use App\Domain\Screen\Events\ScreenAddedToOrganizationEvent;
use Domain\Screen\Models\PairingCode;
use Domain\Screen\Models\Screen;
use Illuminate\Support\Facades\Broadcast;
use Lorisleiva\Actions\Concerns\AsAction;

class AssignScreenAction
{
    use AsAction;

    public function handle(array $data)
    {
        /** @var PairingCode $pairingCode */
        $pairingCode = PairingCode::query()->where('code', $data["code"])->first();

        /** @var Screen $screen */
        $screen = Screen::query()->find($pairingCode->screen_id);

        $screen->update([
            "organization_id" => $data["organization_id"],
            "created_by" => $data["created_by"],
        ]);

        $pairingCode->update([
            "organization_id" => $data["organization_id"],
        ]);

        Broadcast::event(new ScreenAddedToOrganizationEvent($pairingCode->code));
    }

}
