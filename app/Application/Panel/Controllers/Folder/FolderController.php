<?php

declare(strict_types=1);

namespace App\Application\Panel\Controllers\Folder;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\CreateFolderRequest;
use App\Application\Panel\Requests\DeleteFolderRequest;
use App\Application\Panel\Requests\UpdateFolderRequest;
use App\Application\Shared\Responses\ErrorResponse;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Folder\CreateFolderAction;
use App\Domain\Media\Actions\Folder\DeleteFolderAction;
use App\Domain\Media\Actions\Folder\GetAllFoldersAction;
use App\Domain\Media\Actions\Folder\UpdateFolderAction;
use App\Domain\Media\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FolderController extends PanelAppBaseController
{
    /**
     * Panel:
     *
     * @param Request $request
     * @return Response
     */
    public function list(Request $request): Response
    {
        $folders = GetAllFoldersAction::run($request->user()->organization_id);

        return new SuccessResponse($folders);
    }

    /**
     * Panel:
     *
     * @param CreateFolderRequest $request
     * @return Response
     */
    public function create(CreateFolderRequest $request): Response
    {
        /** @var Folder|string $folder */
        $folder = CreateFolderAction::run($request->user()->organization_id, $request->user()->id, $request->validated());

        if ($folder === "parentNotFound") {
            return new ErrorResponse("The selected parent id is invalid.", 422);
        }

        if ($folder === "exist") {
            return new ErrorResponse("The name has already been taken", 406);
        }

        return new SuccessResponse($folder);
    }

    /**
     * Panel:
     *
     * @param UpdateFolderRequest $request
     * @return Response
     */
    public function update(UpdateFolderRequest $request): Response
    {
        /** @var Folder|string $folder */
        $folder = UpdateFolderAction::run($request->user()->organization_id, $request->validated());

        if ($folder === "exist") {
            return new ErrorResponse("The name has already been taken", 406);
        }

        if ($folder === "system") {
            return new ErrorResponse("Can not edit this folder", 406);
        }

        return new SuccessResponse($folder);
    }

    /**
     * Panel:
     *
     * @param DeleteFolderRequest $request
     * @return Response
     */
    public function delete(DeleteFolderRequest $request): Response
    {
        /** @var bool|string $folder */
        $folder = DeleteFolderAction::run($request->validated());

        if ($folder === "system") {
            return new ErrorResponse("Can not edit this folder", 406);
        }

        if ($folder === "hasChildren") {
            return new ErrorResponse("This folder has children", 406);
        }

        return new SuccessResponse();
    }

}
