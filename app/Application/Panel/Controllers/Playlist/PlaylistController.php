<?php

namespace App\Application\Panel\Controllers\Playlist;

use App\Application\Panel\Controllers\PanelAppBaseController;
use App\Application\Panel\Requests\PlaylistStoreRequest;
use App\Domain\Media\Actions\Playlist\AddItemToPlaylistAction;
use App\Domain\Media\Actions\Playlist\StorePlaylistAction;
use App\Domain\Media\DataTransferObjects\PlaylistDTO;
use Illuminate\Http\Request;

class PlaylistController extends PanelAppBaseController
{
    public function index(Request $request)
    {
        //todo return list of playlists
    }

    public function store(PlaylistStoreRequest $request)
    {
        $playlistDTO = PlaylistDTO::from($request);
        return StorePlaylistAction::run($playlistDTO);
    }
}
