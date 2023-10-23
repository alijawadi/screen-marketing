<?php

namespace Domain\User\Actions;

use App\Domain\Media\Models\Folder;
use App\Domain\User\DataTransferObjects\AuthUserDTO;
use App\Domain\User\DataTransferObjects\UserDTO;
use Domain\User\Models\Organization;
use Domain\User\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterUserAction
{
    use AsAction;

    /**
     * @unauthenticated
     */
    public function handle(UserDTO $data): AuthUserDTO
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

        /** @var User $user */
        $user = User::query()
            ->create([
                "organization_id" => $organization->id,
                "uuid" => null,
                "name" => $data->name,
                "email" => $data->email,
                "password" => $data->password,
                "email_verified_at" => null,
                "is_organization_owner" => true,
            ]);

        return AuthUserDTO::from(["token" => $user->createToken('register')->plainTextToken]);
    }

}
