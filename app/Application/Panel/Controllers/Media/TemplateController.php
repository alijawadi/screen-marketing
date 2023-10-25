<?php

namespace App\Application\Panel\Controllers\Media;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\AddTemplateFileRequest;
use App\Application\Panel\Requests\TemplateUpdateRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Template\AddTemplateFileAction;
use App\Domain\Media\Actions\Template\GetTemplateAction;
use App\Domain\Media\Actions\Template\UpdateTemplateAction;
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
     * @param TemplateUpdateRequest $request
     * @return SuccessResponse
     */
    public function removeTemplateFile(AddUpdateFileRequest $request): SuccessResponse
    {
        AddTemplateFileAction::run($request->user()->organization_id, $request->validated());

        return new SuccessResponse();
    }

    /**
     * Panel: Update a Template
     *
     * @param TemplateUpdateRequest $request
     * @return SuccessResponse
     */
    public function update(TemplateUpdateRequest $request): SuccessResponse
    {
        UpdateTemplateAction::run($request->user()->organization_id, $request->validated());

        return new SuccessResponse();
    }
}
