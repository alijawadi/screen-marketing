<?php

namespace App\Domain\Media\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Media extends Model //implements HasMedia
{
    // use InteractsWithMedia;

    protected $table = "media";

    protected $fillable = [
        "organization_id",
        "folder_id",
        "uploaded_by",
        "uuid",
        "name",
        "file_name",
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
        "uuid" => "string",
        "name" => "string",
        "file_name" => "string",
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


//    public function registerMediaConversions(SpatieMedia $media = null): void
//    {
//        $this
//            ->addMediaConversion('preview')
//            ->fit(Manipulations::FIT_CROP, 300, 300)
//            ->nonQueued();
//    }

}
