<?php

namespace App\Domain\Media\Actions\Canvas;

use App\Domain\Media\Models\Canvas;
use App\Services\AwsService;
use Illuminate\Http\UploadedFile;
use Lorisleiva\Actions\Concerns\AsObject;

class AddCanvasFileAction
{
    use AsObject;

    public function handle(int $organization_id, array $data)
    {
        /** @var Canvas $canvas */
        $canvas = Canvas::query()
            ->where("organization_id", "=", $organization_id)
            ->first();

        /** @var UploadedFile $file */
        $file = $data["template_file"];

        $awsService = new AwsService();
        $file = $awsService->uploadFile("root_" . $organization_id . "/templates/images/" . $data["template_id"] . time() . $file->getClientOriginalName(), $file);

        $templates = json_decode(json_encode($canvas->templates), true);
        $templates[$data["template_id"]] = [
            "id" => $data["template_id"],
            "key" => $file[0],
            "url" => $file[1],
        ];

        $canvas->update([
            "templates" => $templates,
        ]);
    }

}
