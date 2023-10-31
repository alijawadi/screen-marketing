<?php

namespace App\Application\Panel\Controllers\Screen;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\SetScreenContentByMediaIdRequest;
use App\Application\Panel\Requests\SetScreenContentByPlaylistIdRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Screen\Actions\Content\SetContentByMediaIdAction;
use App\Domain\Screen\Actions\Content\SetContentByPlaylistIdAction;
use App\Domain\Screen\DataTransferObjects\SetContentByMediaDTO;
use App\Domain\Screen\DataTransferObjects\SetContentByPlaylistDTO;

class ScreenContentController extends PanelAppBaseController
{
    /**
     * Set Screen content by Media_ID
     *
     * @param SetScreenContentByMediaIdRequest $request
     * @return SuccessResponse
     */
    public function setScreenContentByMediaId(SetScreenContentByMediaIdRequest $request): SuccessResponse
    {
        $dto = SetContentByMediaDTO::from($request->validated());
        $data = SetContentByMediaIdAction::run($dto);
        return new SuccessResponse($data);
    }

    /**
     * Set Screen content by Playlist_ID
     *
     * @param SetScreenContentByPlaylistIdRequest $request
     * @return SuccessResponse
     */
    public function setScreenContentByPlaylistId(SetScreenContentByPlaylistIdRequest $request): SuccessResponse
    {
        $dto = SetContentByPlaylistDTO::from($request->validated());
        $data = SetContentByPlaylistIdAction::run($dto);
        return new SuccessResponse($data);
    }
}
