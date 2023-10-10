<?php

namespace App\Domain\Media\Actions\Media;

use App\Domain\Media\DataTransferObjects\MediaDTO;
use App\Domain\Media\Models\Media;
use Lorisleiva\Actions\Concerns\AsObject;

class RetrieveMediaAction
{
    use AsObject;

    public function handle()
    {
        return MediaDTO::collection(Media::paginate());
    }
}
