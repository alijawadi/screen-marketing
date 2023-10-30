<?php

namespace App\Domain\Media\Actions\Canvas;

use App\Domain\Media\Models\Canvas;
use App\Domain\Media\Models\Folder;
use App\Domain\Media\Models\Media;
use App\Services\AwsService;
use Illuminate\Http\UploadedFile;
use Lorisleiva\Actions\Concerns\AsObject;

class AddCanvasFileAction
{
    use AsObject;

    public function handle(int $organization_id, int $userId, array $data): bool|string
    {
        /** @var Canvas $canvas */
        $canvas = Canvas::query()
            ->where("organization_id", "=", $organization_id)
            ->first();

        /** @var Folder $folder */
        $folder = Folder::query()
            ->where("organization_id", "=", $organization_id)
            ->where("key", "=", "root_" . $organization_id . "/canvas/images")
            ->select(["id", "key"])
            ->first();

        if (!$folder) {
            return "folderNotFound";
        }

        /** @var UploadedFile $file */
        $file = $data["file1"];

        $size = $file->getSize();
        $mimeType = $file->getMimeType();
        $name = time() . "_" . $file->getClientOriginalName();

        $awsService = new AwsService();
        $file = $awsService->uploadFile($folder->key . "/" . $name, $file);

        if (!$file) {
            return "notUploaded";
        }

        /** @var Media $media */
        $media = Media::query()
            ->create([
                "organization_id" => $organization_id,
                "folder_id" => $folder->id,
                "uploaded_by" => $userId,
                "model_type" => Canvas::class,
                "model_id" => $canvas->id,
                "uuid" => null,
                "name" => $name,
                "mime_type" => $mimeType,
                "size" => $size,
                "key" => $file[0],
                "url" => $file[1],
            ]);

        $templates = json_decode(json_encode($canvas->templates), true);
        $templates[$data["id"]] = [
            "id" => $data["id"],
            "url" => $file[1],
            "media_id" => $media->id,
        ];

        $canvas->update([
            "templates" => $templates,
        ]);

        return true;
    }

}
