<?php

namespace App\Domain\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistItem extends Model
{
    use HasFactory;

    protected $table = "playlists";

    protected $fillable = [
        "playlist_id",
        "created_by",
        "updated_by",
        "item_type",
        "duration",
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
        "order_column" => "integer",
    ];

    protected $dates = [
        "created_at",
        "updated_at",
    ];

    protected $guarded = [
        "id"
    ];


}
