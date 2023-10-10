<?php

namespace App\Domain\Media\DataTransferObjects;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class FolderDTO extends Data
{
    public function __construct(
        #[MapInputName('folder_id')]
        public ?int    $id,
        public ?string $uuid,
        public string  $name,
        public ?int    $parent_id
    ){}
}
