<?php

namespace App\Domain\Media\Actions\Media;

use App\Domain\Media\DataTransferObjects\MediaDTO;
use Lorisleiva\Actions\Concerns\AsObject;

class StoreMediaAction
{
    use AsObject;

    public function handle(MediaDTO $mediaDTO)
    {

    }
}
