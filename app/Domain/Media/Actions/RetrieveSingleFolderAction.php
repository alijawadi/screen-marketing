<?php

namespace App\Domain\Media\Actions;

use App\Domain\Media\DataTransferObjects\FolderDTO;
use App\Domain\Media\Models\Folder;
use Lorisleiva\Actions\Concerns\AsObject;

class RetrieveSingleFolderAction
{
    use AsObject;

    public function handle(FolderDTO $folderDTO): FolderDTO
    {
        $folder = Folder::findOrFail($folderDTO->id);
        return FolderDTO::from($folder);
    }
}
