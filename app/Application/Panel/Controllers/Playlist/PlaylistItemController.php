<?php

namespace App\Application\Panel\Controllers\Playlist;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\Playlist\PlaylistItemOrderUpdateRequest;
use App\Application\Panel\Requests\Playlist\PlaylistItemStoreRequest;
use App\Application\Panel\Requests\Playlist\PlaylistItemUpdateRequest;
use App\Application\Shared\Responses\DeletedResponse;
use App\Application\Shared\Responses\ErrorResponse;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Playlist\PlaylistItem\AddMediaToPlaylistAction;
use App\Domain\Media\Actions\Playlist\PlaylistItem\DeletePlaylistItemAction;
use App\Domain\Media\Actions\Playlist\PlaylistItem\UpdatePlaylistItemAction;
use App\Domain\Media\Actions\Playlist\PlaylistItem\UpdatePlaylistOrderItemsAction;
use App\Domain\Media\DataTransferObjects\Playlist\AddMediaToPlaylistDTO;
use App\Domain\Media\DataTransferObjects\Playlist\PlaylistUpdateOrderDTO;
use App\Domain\Media\DataTransferObjects\Playlist\UpdatePlaylistItemDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaylistItemController extends PanelAppBaseController
{
    /**
     * Add Media to Playlist
     *
     * @param PlaylistItemStoreRequest $request
     * @return SuccessResponse
     */
    public function setMediaToPlaylist(PlaylistItemStoreRequest $request): SuccessResponse
    {
        $setMediaDTO = AddMediaToPlaylistDTO::from($request->validated());
        $dto = AddMediaToPlaylistAction::run($setMediaDTO);

        return new SuccessResponse($dto);
    }

    /**
     * Update a single Playlist Item
     *
     * @param PlaylistItemUpdateRequest $request
     * @return SuccessResponse
     */
    public function updatePlaylistItem(PlaylistItemUpdateRequest $request): SuccessResponse
    {
        $dto = UpdatePlaylistItemDTO::from($request->validated());
        $data = UpdatePlaylistItemAction::run($dto);

        return new SuccessResponse($data);
    }

    /**
     * Update Playlist Items Order
     *
     * @param PlaylistItemOrderUpdateRequest $request
     * @return SuccessResponse
     */
    public function updatePlaylistItemOrder(PlaylistItemOrderUpdateRequest $request): SuccessResponse
    {
        $dto = PlaylistUpdateOrderDTO::from($request->validated());
        $data = UpdatePlaylistOrderItemsAction::run($dto);

        return new SuccessResponse($data);
    }

    /**
     * Delete a single Playlist Item
     * @param Request $request
     * @return Response
     */
    public function deletePlaylistItem(Request $request): Response
    {
        $dto = UpdatePlaylistItemDTO::from(['id' => $request->id]);
        $isDeleted = DeletePlaylistItemAction::run($dto);

        return $isDeleted ? new DeletedResponse() : new ErrorResponse();
    }
}
