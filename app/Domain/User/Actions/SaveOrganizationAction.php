<?php

namespace Domain\User\Actions;

use Domain\User\Models\Organization;
use Lorisleiva\Actions\Concerns\AsAction;

class SaveOrganizationAction
{
    use AsAction;

    public function handle(int $organization_id, array $data): Organization
    {
        /** @var Organization $organization */
        $organization = Organization::query()->find($organization_id);

        $organization->update($data);

        return $organization;
    }

}
