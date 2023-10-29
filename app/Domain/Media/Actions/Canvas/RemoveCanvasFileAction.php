<?php

namespace App\Domain\Media\Actions\Canvas;

use App\Domain\Media\Models\Canvas;
use App\Domain\Media\Models\Media;
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

        if (isset($templates[$data["id"]])) {
            /** @var Media $media */
            $media = Media::query()->find($templates[$data["id"]]["media_id"]);

            $awsService = new AwsService();
            $awsService->removeFileAndFolder($media->key);

            $media->delete();

            //*******************************************
            unset($templates[$data["id"]]);

            $canvas->update([
                "templates" => $templates,
            ]);
        }
    }

}
