<?php

namespace App\Domain\Media\DataTransferObjects\Playlist;

use App\Domain\Media\Models\Playlist;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;

class PlaylistDTO extends Data
{
    public function __construct(
        public ?int $id,
        public ?string $name,
        #[DataCollectionOf(PlaylistItemDTO::class)]
        public Lazy|DataCollection $items
    ){}

    public static function fromModel(Playlist $playlist): self
    {
        return new self(
            $playlist->id,
            $playlist->name,
            Lazy::create(fn() => PlaylistItemDTO::collection($playlist->items))
        );
    }
}
