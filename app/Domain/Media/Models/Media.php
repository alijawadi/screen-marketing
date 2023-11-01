<?php

namespace App\Domain\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Media extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory, HasUuid, SoftDeletes;

    protected $table = "media";

    protected $fillable = [
        "organization_id",
        "folder_id",
        "uploaded_by",
        "model_type",
        "model_id",
        "uuid",
        "name",
        "mime_type",
        "size",
        "url",
        "key",


//        "collection_name",
//        "disk",
//        "conversions_disk",
//        "manipulations",
//        "custom_properties",
//        "generated_conversions",
//        "responsive_images",
//        "order_column",
    ];

    /**
     * The attributes that should be cast to native types.
     * integer, real, float, double, string, boolean, object, array,
     * collection, date, datetime, and timestamp
     *
     * @var array
     */
    protected $casts = [
        "organization_id" => "integer",
        "folder_id" => "integer",
        "uploaded_by" => "integer",
        "model_type" => "string",
        "model_id" => "integer",
        "uuid" => "string",
        "name" => "string",
        "mime_type" => "string",
        "size" => "integer",
        "url" => "string",
        "key" => "string",

//        "collection_name" => "string",
//        "disk" => "string",
//        "conversions_disk" => "string",
//        "manipulations" => "object",
//        "custom_properties" => "object",
//        "generated_conversions" => "object",
//        "responsive_images" => "object",
//        "order_column" => "integer",
    ];

    protected $dates = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        "model_type",
        "model_id",
    ];

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(SpatieMedia $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function playlistItem(): MorphOne
    {
        return $this->morphOne(PlaylistItem::class, 'contentable');
    }
}
