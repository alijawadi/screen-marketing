<?php

namespace App\Application\Panel\Controllers\Template;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\AddTemplateFileRequest;
use App\Application\Panel\Requests\RemoveTemplateFileRequest;
use App\Application\Panel\Requests\SaveTemplateStoreRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Template\AddTemplateFileAction;
use App\Domain\Media\Actions\Template\GetTemplateAction;
use App\Domain\Media\Actions\Template\RemoveTemplateFileAction;
use App\Domain\Media\Actions\Template\SaveTemplateStoreAction;
use App\Domain\Media\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TemplateController extends PanelAppBaseController
{
    /**
     * Panel: Get Templates (Paginated)
     *
     * @param Request $request
     * @return Response
     */
    public function get(Request $request): Response
    {
        /** @var Template $template */
        $template = GetTemplateAction::run($request->user()->organization_id);

        return new SuccessResponse($template);
    }

    /**
     * Panel: Update a Template
     *
     * @param AddTemplateFileRequest $request
     * @return SuccessResponse
     */
    public function addTemplateFile(AddTemplateFileRequest $request): SuccessResponse
    {
        AddTemplateFileAction::run($request->user()->organization_id, $request->validated());

        return new SuccessResponse();
    }

    /**
     * Panel: Update a Template
     *
     * @param RemoveTemplateFileRequest $request
     * @return SuccessResponse
     */
    public function removeTemplateFile(RemoveTemplateFileRequest $request): SuccessResponse
    {
        RemoveTemplateFileAction::run($request->user()->organization_id, $request->validated());

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
        SaveTemplateStoreAction::run($request->user()->organization_id, $request->validated());

        return new SuccessResponse();
    }
}
