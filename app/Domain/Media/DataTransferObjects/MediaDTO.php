<?php

namespace App\Domain\Media\DataTransferObjects;

use Spatie\LaravelData\Data;

class MediaDTO extends Data
{
    public function __construct(
        public int    $id,
        public string $name,
        public int    $size,
    ){}
}
