<?php

namespace App\Domain\Media\Actions\Media;

use App\Domain\Media\DataTransferObjects\FolderDTO;
use App\Domain\Media\DataTransferObjects\StoreMediaDTO;
use App\Domain\Media\Models\Folder;
use Lorisleiva\Actions\Concerns\AsObject;

class StoreMediaAction
{
    use AsObject;

    public function handle(StoreMediaDTO $storeMediaDTO): FolderDTO
    {
        $folder = Folder::find($storeMediaDTO->folder_id);
        $folder->addMediaFromBase64($storeMediaDTO->file)->toMediaCollection();

        return FolderDTO::from($folder);
    }
}
