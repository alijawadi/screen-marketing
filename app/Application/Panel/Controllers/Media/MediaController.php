<?php

namespace App\Application\Panel\Controllers\Media;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\GetAllMediaRequest;
use App\Application\Panel\Requests\RemoveMediaRequest;
use App\Application\Panel\Requests\UploadMediaRequest;
use App\Application\Shared\Responses\ErrorResponse;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Media\GetAllMediaAction;
use App\Domain\Media\Actions\Media\RemoveMediaAction;
use App\Domain\Media\Actions\Media\UploadMediaAction;
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
     *
     * @param UploadMediaRequest $request
     * @return Response
     */
    public function upload(UploadMediaRequest $request): Response
    {
        $media = UploadMediaAction::run($request->user()->organization_id, $request->user()->id, $request->validated());

        if ($media === "folderNotFound") {
            return new ErrorResponse("The selected folder id is invalid.", 422);
        }

        if ($media === "notUploaded") {
            return new ErrorResponse("Upload to CDN failed.", 500);
        }

        return new SuccessResponse($media, 201);
    }

    /**
     * Upload Media
     *
     * @param RemoveMediaRequest $request
     * @return Response
     */
    public function remove(RemoveMediaRequest $request): Response
    {
        $result = RemoveMediaAction::run($request->user()->organization_id, $request->validated());

        if ($result === "notFound") {
            return new ErrorResponse("The selected id is invalid.", 422);
        }

        return new SuccessResponse();
    }


}
