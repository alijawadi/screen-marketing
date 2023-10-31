<?php

namespace App\Domain\Media\DataTransferObjects;

use App\Domain\Media\Models\PlaylistItem;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class PlaylistItemDTO extends Data
{
    public function __construct(
        #[MapOutputName('media')]
        public MediaDTO $contentable,
        public int $playlist_id,
        public int $order
    )
    {
    }

    public static function fromModel(PlaylistItem $playlistItem): self
    {
        return new self(
            MediaDTO::from($playlistItem->contentable),
            $playlistItem->playlist_id,
            $playlistItem->order,
        );
    }
}
