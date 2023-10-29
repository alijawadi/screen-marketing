<?php

namespace App\Domain\Media\DataTransferObjects;

use Spatie\LaravelData\Data;

class TemplateStoreDTO extends Data
{
    public function __construct(
        public string $file,
        public string $data,
        public ?int  $id
    )
    {
    }
}
