<?php

namespace App\Domain\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PlaylistItem extends Model
{
    use HasFactory;

    protected $table = "playlist_items";

    protected $fillable = [
        "playlist_id",
        "created_by",
        "updated_by",
        "item_type",
        "duration",
        "repeat_type", //no - daily - weekly - monthly - yearly - custom
        "order_column",
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
        "item_id" => "integer",
        "playlist_id" => "integer",
        "item_type" => "string",
        "duration" => "integer",
        "repeat_type" => "string",
        "order_column" => "integer",
    ];

    protected $dates = [
        "created_at",
        "updated_at",
    ];

    protected $guarded = [
        "id"
    ];

    public function playlist(): BelongsTo
    {
        return $this->belongsTo(Playlist::class);
    }

    public function contentable(): MorphTo
    {
        return $this->morphTo();
    }
}
