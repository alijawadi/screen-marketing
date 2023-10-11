<?php

namespace App\Application\Panel\Controllers\Media;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\MediaStoreRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Media\ListMediaAction;
use App\Domain\Media\Actions\Media\StoreMediaAction;
use App\Domain\Media\DataTransferObjects\StoreMediaDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MediaController extends PanelAppBaseController
{
    /**
     * Retrieve All Media
     * (paginated)
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $media = ListMediaAction::run($request);
        return new SuccessResponse($media);
    }

    /**
     * Upload Media
     * @param MediaStoreRequest $request
     * @return SuccessResponse
     */
    public function store(MediaStoreRequest $request): SuccessResponse
    {
        $mediaDto = StoreMediaAction::run(StoreMediaDTO::from($request));
        return new SuccessResponse($mediaDto, 201);
    }
}
