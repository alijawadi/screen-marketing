<?php

namespace App\Domain\Media\Actions\Folder;

use App\Domain\Media\Models\Folder;
use App\Services\AwsService;
use Lorisleiva\Actions\Concerns\AsObject;

class UpdateFolderAction
{
    use AsObject;

    public function handle(int $organization_id, array $data): Folder|string
    {
        /** @var Folder $folder */
        $folder = Folder::query()->select(["id", "key", "name", "parent_id"])->find($data["id"]);

        $key = "root_" . $organization_id;

        if ($folder->parent_id) {
            /** @var Folder $parent */
            $parent = Folder::query()->select(["id", "key"])->find($folder->parent_id);

            $key = $parent->key;
        }

        //***************************************************
        /** @var Folder $folderExist */
        $folderExist = Folder::query()->select(["id", "key"])
            ->where("key", "=", $key . "/" . $data["name"])
            ->where("id", "!=", $folder->id)
            ->first();

        if ($folderExist) {
            return "exist";
        }

        //***************************************************
        $folder->update([
            "name" => $data["name"],
            "key" => $key . "/" . $data["name"],
        ]);

        $awsService = new AwsService();
        $awsService->createDirectory($folder->key);

        return $folder;
    }

}
