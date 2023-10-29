<?php

namespace App\Domain\Media\Actions\Canvas;

use App\Domain\Media\Models\Canvas;
use App\Services\AwsService;
use Lorisleiva\Actions\Concerns\AsObject;

class RemoveCanvasFileAction
{
    use AsObject;

    public function handle(int $organization_id, array $data)
    {
        /** @var Canvas $canvas */
        $canvas = Canvas::query()
            ->where("organization_id", "=", $organization_id)
            ->first();

        $templates = json_decode(json_encode($canvas->templates), true);

        if (isset($templates[$data["template_id"]])) {
            $awsService = new AwsService();
            $awsService->removeFileAndFolder($templates[$data["template_id"]]["key"]);

            unset($templates[$data["template_id"]]);

            $canvas->update([
                "templates" => $templates,
            ]);
        }
    }

}
