<?php

namespace App\Domain\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $table = "playlists";

    protected $fillable = [
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
}
