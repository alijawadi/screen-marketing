<?php

namespace App\Domain\Media\DataTransferObjects\Playlist;

use Spatie\LaravelData\Data;

class UpdatePlaylistItemDTO extends Data
{
    public function __construct(
        public int $id,
        public ?int $order,
        public ?int $duration,
    )
    {
    }
}
