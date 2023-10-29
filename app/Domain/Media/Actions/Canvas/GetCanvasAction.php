<?php

namespace App\Domain\Media\Actions\Canvas;

use App\Domain\Media\Models\Canvas;
use Lorisleiva\Actions\Concerns\AsObject;

class GetCanvasAction
{
    use AsObject;

    public function handle(int $organization_id)
    {
        /** @var Canvas $canvas */
        $canvas = Canvas::query()
            ->where("organization_id", "=", $organization_id)
            ->first();

        return $canvas;
    }
}
