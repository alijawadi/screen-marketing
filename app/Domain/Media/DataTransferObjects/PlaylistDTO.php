<?php

namespace App\Domain\Media\DataTransferObjects;

use Spatie\LaravelData\Data;

class PlaylistDTO extends Data
{
    public function __construct(
        public string $name,
    ){}
}
