<?php

namespace App\Domain\Media\DataTransferObjects;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class FolderDTO extends Data
{
    public function __construct(
        #[MapInputName('folder_id')]
        public ?int $id,
        public ?string $uuid,
        public ?string $name,
        public ?int $parent_id,
        #[DataCollectionOf(MediaDTO::class)]
        public ?DataCollection $media
    )
    {
    }
}
