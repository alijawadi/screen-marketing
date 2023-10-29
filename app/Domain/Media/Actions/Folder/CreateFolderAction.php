<?php

namespace App\Domain\Media\Actions\Folder;

use App\Domain\Media\Models\Folder;
use App\Services\AwsService;
use Lorisleiva\Actions\Concerns\AsObject;

class CreateFolderAction
{
    use AsObject;

    public function handle(int $organization_id, int $userId, array $data): Folder|string
    {
        $key = "root_" . $organization_id;

        if ($data["parent_id"]) {
            /** @var Folder $folder */
            $folder = Folder::query()->select(["id", "key"])->find($data["parent_id"]);

            $key = $folder->key;
        }

        //***************************************************
        /** @var Folder $folder */
        $folder = Folder::query()->select(["id", "key"])
            ->where("key", "=", $key . "/" . $data["name"])
            ->first();

        if ($folder) {
            return "exist";
        }

        //***************************************************
        /** @var Folder $folder */
        $folder = Folder::query()
            ->create([
                "organization_id" => $organization_id,
                "parent_id" => $data["parent_id"],
                "created_by" => $userId,
                "updated_by" => null,
                "uuid" => null,
                "name" => $data["name"],
                "key" => $key . "/" . $data["name"],
                "is_system" => false,
            ]);

        $awsService = new AwsService();
        $awsService->createDirectory($folder->key);

        return $folder;
    }

}
