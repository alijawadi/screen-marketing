<?php

namespace App\Domain\Media\DataTransferObjects\Playlist;

use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Data;

class PlaylistUpdateOrderDTO extends Data
{
    public function __construct(
        public int $playlist_id,
        #[ArrayType(['id', 'order'])]
        public array $playlist_items,
    )
    {
    }
}
