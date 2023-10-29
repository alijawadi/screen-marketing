<?php

namespace App\Domain\Media\DataTransferObjects;

use App\Domain\Media\Models\Canvas;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;

class TemplateDTO extends Data
{
    public function __construct(
        public int     $id,
        public ?string $name,
        public ?string $data,
        public string  $created_at,
        public ?string $updated_at,
        #[DataCollectionOf(MediaDTO::class)]
        public ?DataCollection $media
    )
    {
    }

    public static function fromModel(Canvas $template): self
    {
        //todo: instead of this, eager load with a scope.
        $template->getMedia("*");
        return new self(
            $template->id,
            $template->name,
            $template->data,
            $template->created_at,
            $template->updated_at,
            MediaDTO::collection($template->media)
        );
    }
}
