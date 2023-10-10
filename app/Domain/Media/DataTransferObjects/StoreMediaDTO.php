<?php

namespace App\Domain\Media\DataTransferObjects;

use Spatie\LaravelData\Data;

class StoreMediaDTO extends Data
{
    public function __construct(
        public mixed $file
    ){}
}
