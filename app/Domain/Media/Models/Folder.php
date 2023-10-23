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

    protected $table = 'folders';

    protected $fillable = [
        'created_by',
        'updated_by',
        'uuid',
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     * integer, real, float, double, string, boolean, object, array,
     * collection, date, datetime, and timestamp
     *
     * @var array
     */
    protected $casts = [
        "created_by" => "integer",
        "updated_by" => "integer",
        "uuid" => "string",
        "name" => "string",
    ];

    protected $dates = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

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
