<?php

declare(strict_types=1);

namespace App\Application\Panel\Controllers\Folder;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\CreateFolderRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Folder\CreateFolderAction;
use App\Domain\Media\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends PanelAppBaseController
{
    /**
     * Panel:
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

    /**
     * Panel:
     *
     * @param CreateFolderRequest $request
     * @return SuccessResponse
     */
    public function create(CreateFolderRequest $request): SuccessResponse
    {
        /** @var Folder $folder */
        $folder = CreateFolderAction::run($request->user()->organization_id, $request->user()->id, $request->validated());

        return new SuccessResponse($folder);
    }


}
