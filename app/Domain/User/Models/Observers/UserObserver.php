<?php

namespace App\Domain\User\Models\Observers;

use Domain\User\Models\Organization;
use Domain\User\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if (!$user->organization_id) {
            $user->update([
                "organization_id" => Organization::create()->id
            ]);
        }
    }
}
