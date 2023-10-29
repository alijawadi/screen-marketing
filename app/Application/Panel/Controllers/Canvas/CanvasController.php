<?php

namespace App\Application\Panel\Controllers\Canvas;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\AddTemplateFileRequest;
use App\Application\Panel\Requests\RemoveTemplateFileRequest;
use App\Application\Panel\Requests\SaveTemplateStoreRequest;
use App\Application\Shared\Responses\ErrorResponse;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Canvas\AddCanvasFileAction;
use App\Domain\Media\Actions\Canvas\GetCanvasAction;
use App\Domain\Media\Actions\Canvas\RemoveCanvasFileAction;
use App\Domain\Media\Actions\Canvas\SaveCanvasStoreAction;
use App\Domain\Media\Models\Canvas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CanvasController extends PanelAppBaseController
{
    /**
     * Panel: Get Templates (Paginated)
     *
     * @param Request $request
     * @return Response
     */
    public function get(Request $request): Response
    {
        /** @var Canvas $template */
        $template = GetCanvasAction::run($request->user()->organization_id);

        return new SuccessResponse($template);
    }

    /**
     * Panel: Update a Template
     *
     * @param AddTemplateFileRequest $request
     * @return Response
     */
    public function addFile(AddTemplateFileRequest $request): Response
    {
        $result = AddCanvasFileAction::run($request->user()->organization_id, $request->user()->id, $request->validated());

        if ($result === "folderNotFound") {
            return new ErrorResponse("The selected folder id is invalid.", 422);
        }

        if ($result === "notUploaded") {
            return new ErrorResponse("Upload to CDN failed.", 500);
        }

        return new SuccessResponse();
    }

    /**
     * Panel: Update a Template
     *
     * @param RemoveTemplateFileRequest $request
     * @return SuccessResponse
     */
    public function removeFile(RemoveTemplateFileRequest $request): SuccessResponse
    {
        RemoveCanvasFileAction::run($request->user()->organization_id, $request->validated());

        return new SuccessResponse();
    }

    /**
     * Panel: Update a Template
     *
     * @param SaveTemplateStoreRequest $request
     * @return SuccessResponse
     */
    public function saveStore(SaveTemplateStoreRequest $request): SuccessResponse
    {
        SaveCanvasStoreAction::run($request->user()->organization_id, $request->validated());

        return new SuccessResponse();
    }
}
