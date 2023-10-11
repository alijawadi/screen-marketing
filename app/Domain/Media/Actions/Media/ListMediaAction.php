<?php

namespace App\Domain\Media\Actions\Media;

use App\Domain\Media\DataTransferObjects\FolderDTO;
use App\Domain\Media\DataTransferObjects\MediaDTO;
use App\Domain\Media\Models\Media;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsObject;
use Spatie\LaravelData\CursorPaginatedDataCollection;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class ListMediaAction
{
    use AsObject;

    public function handle()
    {
        //todo get the orgId from app layer
        $folder = Auth::user()->organization->rootFolder;
        $folder->getMedia("*");

        return FolderDTO::from($folder);
    }
}
