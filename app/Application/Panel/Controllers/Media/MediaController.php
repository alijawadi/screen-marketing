<?php

namespace App\Application\Panel\Controllers\Media;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\MediaStoreRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Media\RetrieveMediaAction;
use App\Domain\Media\Actions\RetrieveSingleFolderAction;
use App\Domain\Media\DataTransferObjects\FolderDTO;
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
        $media = RetrieveMediaAction::run($request);
        return new SuccessResponse($media);
    }

    /**
     * Upload Media
     * @param MediaStoreRequest $request
     * @return mixed
     */
    public function store(MediaStoreRequest $request)
    {
        return dd($request->file);
        $folderDTO = FolderDTO::from($request);
        $folderDTO = RetrieveSingleFolderAction::run($folderDTO);

    }
}
