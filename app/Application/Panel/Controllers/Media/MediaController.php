<?php

namespace App\Application\Panel\Controllers\Media;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\GetAllMediaRequest;
use App\Application\Panel\Requests\MediaStoreRequest;
use App\Application\Shared\Responses\ErrorResponse;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Media\GetAllMediaAction;
use App\Domain\Media\Actions\Media\StoreMediaAction;
use App\Domain\Media\DataTransferObjects\StoreMediaDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MediaController extends PanelAppBaseController
{
    /**
     * Retrieve All Media
     *
     * @param GetAllMediaRequest $request
     * @return Response
     */
    public function list(GetAllMediaRequest $request): Response
    {
        $media = GetAllMediaAction::run($request->user()->organization_id, $request->validated());

        if ($media === "folderNotFound") {
            return new ErrorResponse("The selected folder id is invalid.", 422);
        }

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
