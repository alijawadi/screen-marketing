<?php

namespace App\Domain\User\Models\Observers;

use App\Domain\Media\Models\Folder;
use Domain\User\Models\Organization;
use Domain\User\Models\User;

class OrganizationObserver
{
    public function created(Organization $organization): void
    {
        if (!$organization->root_folder_id) {
            $organization->update([
                "root_folder_id" => Folder::create(['name' => "root"])->id
            ]);
        }
    }
}
