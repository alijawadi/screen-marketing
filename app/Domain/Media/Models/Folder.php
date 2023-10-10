<?php

namespace App\Domain\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Folder extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasUuid;

    protected $guarded = [
        'id'
    ];

    public function registerMediaConversions(SpatieMedia $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
}
