<?php

namespace App\Domain\Screen\DataTransferObjects;

use Spatie\LaravelData\Data;

class SetContentDTO extends Data
{
    public function __construct(
        public int $mediaId,
        public int $screenId,
    )
    {
    }
}
