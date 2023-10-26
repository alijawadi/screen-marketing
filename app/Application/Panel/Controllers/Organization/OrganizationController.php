<?php

declare(strict_types=1);

namespace App\Application\Panel\Controllers\Organization;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Shared\Responses\SuccessResponse;
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
        $organization = Organization::query()
            ->where("id", "=", $request->user()->organization_id)
            ->first();

        return new SuccessResponse($organization);
    }

}
