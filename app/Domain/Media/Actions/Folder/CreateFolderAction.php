<?php

namespace App\Domain\Media\Actions\Folder;

use App\Domain\Media\Models\Folder;
use Lorisleiva\Actions\Concerns\AsObject;

class CreateFolderAction
{
    use AsObject;

    public function handle(int $organization_id, int $userId, array $data): Folder
    {
        $path = "root_" . $organization_id;

        /** @var Folder $folder */
        $folder = Folder::query()
            ->create([
                "organization_id" => $organization_id,
                "parent_id" => $data["parent_id"],
                "created_by" => $userId,
                "updated_by" => null,
                "uuid" => null,
                "name" => $data["name"],
                "is_system" => false,
            ]);

        //create folder on cdn

        return $folder;
    }

}
