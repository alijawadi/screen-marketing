<?php

namespace App\Application\Panel\Controllers\Playlist;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\Playlist\PlaylistStoreRequest;
use App\Application\Shared\Responses\DeletedResponse;
use App\Application\Shared\Responses\ErrorResponse;
use App\Application\Shared\Responses\SuccessResponse;
use App\Domain\Media\Actions\Playlist\DeletePlaylistAction;
use App\Domain\Media\Actions\Playlist\PlaylistListAction;
use App\Domain\Media\Actions\Playlist\RetrievePlaylistAction;
use App\Domain\Media\Actions\Playlist\StorePlaylistAction;
use App\Domain\Media\Actions\Playlist\UpdatePlaylistAction;
use App\Domain\Media\DataTransferObjects\Playlist\PlaylistAppLayerDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaylistController extends PanelAppBaseController
{
    /**
     * List of Playlists
     * @return SuccessResponse
     */
    public function index(): SuccessResponse
    {
        return new SuccessResponse(PlaylistListAction::run());
    }

    /**
     * Create New Playlist
     *
     * @param PlaylistStoreRequest $request
     * @return mixed
     */
    public function store(PlaylistStoreRequest $request): mixed
    {
        $PlaylistAppLayerDTO = PlaylistAppLayerDTO::from($request);
        $data = StorePlaylistAction::run($PlaylistAppLayerDTO);

        return new SuccessResponse($data);
    }

    /**
     * Get a Playlist
     *
     * @param Request $request
     * @return SuccessResponse
     */
    public function retrieve(Request $request): SuccessResponse
    {
        $PlaylistAppLayerDTO = PlaylistAppLayerDTO::from(['id' => $request->id]);
        $playlist = RetrievePlaylistAction::run($PlaylistAppLayerDTO);

        return new SuccessResponse($playlist);
    }

    /**
     * Update a Playlist
     * @param PlaylistStoreRequest $request
     * @return SuccessResponse
     */
    public function update(PlaylistStoreRequest $request): SuccessResponse
    {
        $PlaylistAppLayerDTO = PlaylistAppLayerDTO::from($request->validated());
        $playlist = UpdatePlaylistAction::run($PlaylistAppLayerDTO);

        return new SuccessResponse($playlist);
    }

    /**
     * Delete a Playlist
     *
     * @param Request $request
     * @return Response
     */
    public function delete(Request $request): Response
    {
        $dto = PlaylistAppLayerDTO::from(['id' => $request->id]);
        $isDeleted = DeletePlaylistAction::run($dto);

        return $isDeleted ? new DeletedResponse() : new ErrorResponse();
    }
}
