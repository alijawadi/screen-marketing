<?php

namespace App\Domain\Media\DataTransferObjects;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class MediaDTO extends Data
{
    public function __construct(
        public int    $id,
        public string $name,
        public int    $size,
        public        $folder_id,
        #[MapOutputName('url')]
        public ?string $preview_url,
        public string $created_at,
        public string $mime_type,
    )
    {
    }
}
