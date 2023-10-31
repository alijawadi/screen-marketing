<?php

namespace App\Domain\Screen\DataTransferObjects;

use Spatie\LaravelData\Data;

class SetContentByPlaylistDTO extends Data
{
    public function __construct(
        public int $playlist_id,
        public int $screen_id,
    )
    {
    }
}
