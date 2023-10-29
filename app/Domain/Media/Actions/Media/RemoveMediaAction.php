<?php

namespace App\Domain\Media\Actions\Media;

use App\Domain\Media\Models\Folder;
use App\Domain\Media\Models\Media;
use App\Services\AwsService;
use Illuminate\Http\UploadedFile;
use Lorisleiva\Actions\Concerns\AsObject;

class RemoveMediaAction
{
    use AsObject;

    public function handle(int $organization_id, array $data): bool|string
    {
        /** @var Media $media */
        $media = Media::query()
            ->where("organization_id", "=", $organization_id)
            ->where("id", "=", $data["id"])
            ->select(["id", "key"])
            ->first();

        if (!$media) {
            return "notFound";
        }

        $awsService = new AwsService();
        $awsService->removeFileAndFolder($media->key);

        $media->delete();

        return true;
    }

}
