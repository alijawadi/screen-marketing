<?php

namespace Domain\User\Actions;

use App\Domain\Media\Models\Folder;
use App\Domain\User\DataTransferObjects\AuthUserDTO;
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
                "name" => "Organization",
                "description" => null,
            ]);

        /** @var Folder $folder */
        $folder = Folder::query()
            ->create([
                "organization_id" => $organization->id,
                "uuid" => null,
                "name" => "root",
            ]);

        $data["organization_id"] = $organization->id;
        $data["uuid"] = null;
        $data["email_verified_at"] = null;
        $data["is_organization_owner"] = true;

        /** @var User $user */
        $user = User::query()->create($data);

        return $user->createToken('register')->plainTextToken;
    }

}
