<?php

declare(strict_types=1);

namespace App\Application\Panel\Controllers\Organization;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\SaveOrganizationRequest;
use App\Application\Shared\Responses\SuccessResponse;
use Domain\User\Actions\SaveOrganizationAction;
use Domain\User\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends PanelAppBaseController
{
    /**
     * Panel: List of Screens
     *
     * @param Request $request
     * @return SuccessResponse
     */
    public function get(Request $request): SuccessResponse
    {
        $organization = Organization::query()->find($request->user()->organization_id);

        return new SuccessResponse($organization);
    }

    /**
     * Panel: save Organization
     *
     * @param SaveOrganizationRequest $request
     * @return SuccessResponse
     */
    public function save(SaveOrganizationRequest $request): SuccessResponse
    {
        /** @var Organization $organization */
        $organization = SaveOrganizationAction::run($request->user()->organization_id, $request->validated());

        return new SuccessResponse($organization);
    }


}
