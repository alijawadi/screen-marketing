<?php

namespace App\Domain\Media\Actions\Media;

use App\Domain\Media\Models\Folder;
use App\Domain\Media\Models\Media;
use Domain\User\Models\Organization;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsObject;

class GetAllMediaAction
{
    use AsObject;

    public function handle(int $organization_id, array $data): Collection|string
    {
        /** @var Organization $organization */
        $organization = Organization::query()->select(["id", "root_folder_id"])->find($organization_id);

        /** @var Folder $folder */

        if ($data["folder_id"]) {

            $folder = Folder::query()
                ->where("organization_id", "=", $organization_id)
                ->where("id", "=", $data["folder_id"])
                ->select(["id"])
                ->first();

        } else {

            $folder = Folder::query()
                ->where("id", "=", $organization->root_folder_id)
                ->select(["id"])
                ->first();
        }

        if (!$folder) {
            return "folderNotFound";
        }

        return Media::query()
            ->where("organization_id", "=", $organization_id)
            ->where("folder_id", "=", $data["folder_id"])
            ->get();
    }
}
