<?php

namespace App\Domain\Media\Actions\Media;

use App\Domain\Media\Models\Folder;
use App\Domain\Media\Models\Media;
use App\Services\AwsService;
use Illuminate\Http\UploadedFile;
use Lorisleiva\Actions\Concerns\AsObject;

class UploadMediaAction
{
    use AsObject;

    public function handle(int $organization_id, int $userId, array $data): Media|string
    {
        /** @var Folder $folder */
        $folder = Folder::query()
            ->where("organization_id", "=", $organization_id)
            ->where("id", "=", $data["folder_id"])
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
                "uuid" => null,
                "name" => $name,
                "mime_type" => $mimeType,
                "size" => $size,
                "key" => $file[0],
                "url" => $file[1],
            ]);

        return $media;
    }

}
