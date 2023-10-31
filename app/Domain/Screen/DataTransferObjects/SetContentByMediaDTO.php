<?php

namespace App\Domain\Screen\DataTransferObjects;

use Spatie\LaravelData\Data;

class SetContentByMediaDTO extends Data
{
    public function __construct(
        public int $media_id,
        public int $screen_id,
    )
    {
    }
}
