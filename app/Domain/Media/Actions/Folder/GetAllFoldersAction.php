<?php

namespace App\Domain\Media\Actions\Folder;

use App\Domain\Media\Models\Folder;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsObject;

class GetAllFoldersAction
{
    use AsObject;

    public function handle(int $organization_id): Collection
    {
        return Folder::query()
            ->where("organization_id", "=", $organization_id)
            ->whereNull("parent_id")
            ->with(["children"])
            ->get();
    }

}
