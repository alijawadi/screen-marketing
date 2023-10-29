<?php

namespace App\Domain\Media\Actions\Canvas;

use App\Domain\Media\Models\Canvas;
use Lorisleiva\Actions\Concerns\AsObject;

class SaveCanvasStoreAction
{
    use AsObject;

    public function handle(int $organization_id, array $data)
    {
        /** @var Canvas $canvas */
        $canvas = Canvas::query()
            ->where("organization_id", "=", $organization_id)
            ->first();

        $canvas->update([
            "store" => $data["store"],
        ]);
    }

}
