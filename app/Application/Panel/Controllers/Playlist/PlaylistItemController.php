<?php

namespace App\Application\Panel\Controllers\Playlist;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\PlaylistItemStoreRequest;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Playlist\AddMediaToPlaylistAction;
use App\Domain\Media\DataTransferObjects\AddMediaToPlaylistDTO;

class PlaylistItemController extends PanelAppBaseController
{
    /**
     * Add Media to Playlist
     *
     * @param PlaylistItemStoreRequest $request
     * @return SuccessResponse
     */
    public function SetMediaToPlaylist(PlaylistItemStoreRequest $request): SuccessResponse
    {
        $setMediaDTO = AddMediaToPlaylistDTO::from($request->validated());

        $playlist = AddMediaToPlaylistAction::run($setMediaDTO);

        return new SuccessResponse($playlist);
    }
}
