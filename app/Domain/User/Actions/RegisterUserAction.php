<?php

namespace Domain\User\Actions;

use App\Domain\Media\Models\Folder;
use App\Domain\Media\Models\Template;
use Domain\User\Models\Organization;
use Domain\User\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterUserAction
{
    use AsAction;

    /**
     * @unauthenticated
     */
    public function handle(array $data): string
    {
        /** @var Organization $organization */
        $organization = Organization::query()
            ->create([
                "owner_id" => null,
                "name" => "Organization",
                "description" => null,
            ]);

        $data["organization_id"] = $organization->id;
        $data["uuid"] = null;
        $data["email_verified_at"] = null;
        $data["is_organization_owner"] = true;

        /** @var User $user */
        $user = User::query()->create($data);

        Folder::query()
            ->create([
                "organization_id" => $organization->id,
                "created_by" => $user->id,
                "updated_by" => null,
                "uuid" => null,
                "name" => "root",
            ]);

        $organization->update([
            "owner_id" => $user->id,
        ]);

        Template::query()->create([
            "organization_id" => $organization->id,
            "created_by" => $user->id,
            "updated_by" => null,
            "name" => "Template",
            "templates" => [],
            "store" => [],
        ]);

        return $user->createToken('register')->plainTextToken;
    }

}
