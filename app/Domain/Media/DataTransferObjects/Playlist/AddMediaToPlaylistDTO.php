<?php

namespace App\Domain\Media\DataTransferObjects\Playlist;

use Spatie\LaravelData\Data;

class AddMediaToPlaylistDTO extends Data
{
    public function __construct(
        public int $order,
        public int $playlist_id,
        public int $media_id,
        public ?int $duration
    )
    {
    }
}
