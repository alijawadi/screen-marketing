<?php

namespace App\Domain\Media\Actions\Template;

use App\Domain\Media\Models\Template;
use Lorisleiva\Actions\Concerns\AsObject;

class SaveTemplateStoreAction
{
    use AsObject;

    public function handle(int $organization_id, array $data)
    {
        /** @var Template $template */
        $template = Template::query()
            ->where("organization_id", "=", $organization_id)
            ->first();

        $template->update([
            "store" => $data["store"],
        ]);
    }

}
