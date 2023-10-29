<?php

namespace App\Domain\Media\Models;

use Domain\User\Models\Organization;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Folder extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasUuid;

    protected $table = "folders";

    protected $fillable = [
        "organization_id",
        "parent_id",
        "created_by",//nullable
        "updated_by",//nullable
        "uuid",
        "name",
        "key",
        "is_system",//if true then user can not delete it
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
        "parent_id" => "integer",
        "created_by" => "integer",
        "updated_by" => "integer",
        "uuid" => "string",
        "name" => "string",
        "key" => "string",
        "is_system" => "boolean",
    ];

    protected $dates = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    protected $guarded = [
        "id"
    ];

    public function registerMediaConversions(SpatieMedia $media = null): void
    {
        $this
            ->addMediaConversion("preview")
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function children(): HasMany
    {
        return $this->hasMany(Folder::class, "parent_id")->with(["children"]);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Folder::class, "parent_id");
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
