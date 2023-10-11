<?php

namespace App\Application\Panel\Controllers\Media;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\TemplateStoreRequest;
use App\Application\Panel\Requests\TemplateUpdateRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Template\ListTemplateAction;
use App\Domain\Media\Actions\Template\StoreTemplateAction;
use App\Domain\Media\Actions\Template\UpdateTemplateAction;
use App\Domain\Media\DataTransferObjects\TemplateStoreDTO;
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
    public function index(Request $request): Response
    {
        $data = ListTemplateAction::run();
        return new SuccessResponse($data);
    }

    /**
     * Panel: Store a new Template
     *
     * @param TemplateStoreRequest $request
     * @return SuccessResponse
     */
    public function store(TemplateStoreRequest $request): SuccessResponse
    {
        $templateStoreDto = TemplateStoreDTO::from($request);
        $templateDto = StoreTemplateAction::run($templateStoreDto);

        return new SuccessResponse($templateDto, 201);
    }

    /**
     * Panel: Update a Template
     *
     * @param TemplateUpdateRequest $request
     * @return SuccessResponse
     */
    public function update(TemplateUpdateRequest $request): SuccessResponse
    {
        $templateStoreDto = TemplateStoreDTO::from($request);
        $templateDto = UpdateTemplateAction::run($templateStoreDto);

        return new SuccessResponse($templateDto, 201);
    }
}
