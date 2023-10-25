<?php

namespace Domain\User\Actions;

use App\Domain\Media\Models\Folder;
use App\Domain\Media\Models\Template;
use App\Services\AwsService;
use Aws\S3\S3Client;
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

        Folder::query()
            ->create([
                "organization_id" => $organization->id,
                "created_by" => $user->id,
                "updated_by" => null,
                "uuid" => null,
                "name" => "root",
            ]);

        Template::query()->create([
            "organization_id" => $organization->id,
            "created_by" => $user->id,
            "updated_by" => null,
            "name" => "Template",
            "templates" => [],
            "store" => [],
        ]);

        $awsService = new AwsService();
        $awsService->createDirectory("root_" . $organization->id);

        return $user->createToken('register')->plainTextToken;
    }

}
