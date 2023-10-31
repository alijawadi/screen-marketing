<?php

namespace App\Domain\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Playlist extends Model
{
    use HasFactory;

    protected $table = "playlists";

    protected $fillable = [
        "organization_id",
        "created_by",
        "updated_by",
        "name",
        "duration",
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
        "duration" => "integer",
    ];

    protected $dates = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    protected $guarded = [
        "id"
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PlaylistItem::class);
    }
}
