<?php

namespace App\Domain\Media\Actions\Folder;

use App\Domain\Media\Models\Folder;
use Lorisleiva\Actions\Concerns\AsObject;

class DeleteFolderAction
{
    use AsObject;

    public function handle(int $organization_id, array $data): bool|string
    {
        /** @var Folder $folder */
        $folder = Folder::query()->find($data["id"]);

        if ($folder->is_system) {
            return "system";
        }

        $childrenCount = Folder::query()
            ->where("parent_id", "=", $folder->id)
            ->select(["id"])
            ->count();

        if ($childrenCount > 0) {
            return "hasChildren";
        }

        $folder->delete();

        return true;
    }

}
