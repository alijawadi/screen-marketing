<?php

namespace App\Domain\Media\Actions\Canvas;

use App\Domain\Media\Models\Template;
use Lorisleiva\Actions\Concerns\AsObject;

class GetCanvasAction
{
    use AsObject;

    public function handle(int $organization_id)
    {
        /** @var Template $template */
        $template = Template::query()
            ->where("organization_id", "=", $organization_id)
            ->first();

        return $template;
    }
}
