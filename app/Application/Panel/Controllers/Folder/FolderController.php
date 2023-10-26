<?php

declare(strict_types=1);

namespace App\Application\Panel\Controllers\Folder;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\SaveOrganizationRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Models\Folder;
use Domain\User\Actions\SaveOrganizationAction;
use Domain\User\Models\Organization;
use Illuminate\Http\Request;

class FolderController extends PanelAppBaseController
{
    /**
     * Panel: List of Screens
     *
     * @param Request $request
     * @return SuccessResponse
     */
    public function list(Request $request): SuccessResponse
    {
        $folders = Folder::query()
            ->where("organization_id", "=", $request->user()->organization_id)
            ->whereNull("parent_id")
            ->with(["children"])
            ->get();

        return new SuccessResponse($folders);
    }


}
