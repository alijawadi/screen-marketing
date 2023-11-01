<?php

namespace App\Domain\Media\Actions\Playlist;

use App\Domain\Media\DataTransferObjects\Playlist\PlaylistDTO;
use App\Domain\Media\Models\Playlist;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsObject;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class PlaylistListAction
{
    use AsObject;

    public function handle(): DataCollection|CursorPaginatedDataCollection|PaginatedDataCollection
    {
        $paginated = Playlist::query()
            ->where("organization_id", "=", Auth::user()->organization_id)
            ->paginate();
        return PlaylistDTO::collection($paginated);
    }
}
