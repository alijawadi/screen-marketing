<?php

namespace App\Domain\Media\DataTransferObjects\Playlist;

use App\Domain\Media\DataTransferObjects\MediaDTO;
use App\Domain\Media\Models\PlaylistItem;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class PlaylistItemDTO extends Data
{
    public function __construct(
        public int       $id,
        public int       $order,
        public ?int      $duration,
        #[MapOutputName('media')]
        public ?MediaDTO $contentable,
    )
    {
    }

    public static function fromModel(PlaylistItem $playlistItem): self
    {
        return new self(
            $playlistItem->id,
            $playlistItem->order,
            $playlistItem->duration,
            MediaDTO::from($playlistItem->contentable)->exclude('id', 'folder_id', 'created_at'),
        );
    }
}
