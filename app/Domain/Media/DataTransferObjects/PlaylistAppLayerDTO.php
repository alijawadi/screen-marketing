<?php

namespace App\Domain\Media\DataTransferObjects;

use Spatie\LaravelData\Data;

class PlaylistAppLayerDTO extends Data
{
    public function __construct(
        public ?int    $id,
        public ?string $name,
    )
    {
    }
}
