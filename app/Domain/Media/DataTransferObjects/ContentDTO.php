<?php

namespace App\Domain\Media\DataTransferObjects;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class ContentDTO extends Data
{
    public function __construct(
        #[MapOutputName('item')]
        public ?MediaDTO $contentable
    )
    {
    }
}
