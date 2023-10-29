<?php

namespace Domain\User\Actions;

use App\Domain\Media\Models\Folder;
use App\Domain\Media\Models\Canvas;
use App\Services\AwsService;
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
        $data["parent_id"] = null;
        $data["organization_id"] = null;
        $data["uuid"] = null;
        $data["email_verified_at"] = null;
        $data["is_organization_owner"] = true;
        $data["is_active"] = true;
        $data["roles"] = [];
        $data["accesses"] = [];

        /** @var User $user */
        $user = User::query()->create($data);

        /** @var Organization $organization */
        $organization = Organization::query()
            ->create([
                "owner_id" => $user->id,
                "name" => "Organization",
                "description" => null,
                "phone" => null,
                "country_code" => null,
                "country" => null,
                "city" => null,
                "street" => null,
                "postcode" => null,
                "lat" => null,
                "lon" => null,
            ]);

        $user->update([
            "organization_id" => $organization->id,
        ]);

        /** @var Folder $rootFolder */
        $rootFolder = Folder::query()
            ->create([
                "organization_id" => $organization->id,
                "parent_id" => null,
                "created_by" => $user->id,
                "updated_by" => null,
                "uuid" => null,
                "name" => "root",
                "is_system" => true,
            ]);

        /** @var Folder $canvasFolder */
        $canvasFolder = Folder::query()
            ->create([
                "organization_id" => $organization->id,
                "parent_id" => $rootFolder->id,
                "created_by" => $user->id,
                "updated_by" => null,
                "uuid" => null,
                "name" => "canvas",
                "is_system" => true,
            ]);

        Folder::query()
            ->create([
                "organization_id" => $organization->id,
                "parent_id" => $canvasFolder->id,
                "created_by" => $user->id,
                "updated_by" => null,
                "uuid" => null,
                "name" => "images",
                "is_system" => true,
            ]);

        Canvas::query()->create([
            "organization_id" => $organization->id,
            "created_by" => $user->id,
            "updated_by" => null,
            "name" => "Canvas",
            "templates" => [],
            "store" => [],
        ]);

        $awsService = new AwsService();
        $awsService->createDirectory("root_" . $organization->id . "/canvas/images");

        return $user->createToken('register')->plainTextToken;
    }

}
