<?php

namespace App\Domain\Media\Models;

use Domain\User\Models\Organization;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Canvas extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = "canvas";

    protected $fillable = [
        "organization_id",
        "created_by",
        "updated_by",
        "name",
        "templates",
        "store",
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
        "created_by" => "integer",
        "updated_by" => "integer",
        "name" => "string",
        "templates" => "object",
        "store" => "object",
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

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, "organization_id");
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "updated_by");
    }


}
