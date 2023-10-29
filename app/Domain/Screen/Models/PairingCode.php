<?php

namespace Domain\Screen\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PairingCode extends Model
{
    use HasFactory;

    protected $table = "pairing_codes";

    protected $fillable = [
        "screen_id",
        "organization_id",//nullable
        "code",
    ];

    /**
     * The attributes that should be cast to native types.
     * integer, real, float, double, string, boolean, object, array,
     * collection, date, datetime, and timestamp
     *
     * @var array
     */
    protected $casts = [
        "screen_id" => "integer",
        "organization_id" => "integer",
        "code" => "string",
    ];

    protected $dates = [
        "created_at",
        "updated_at",
    ];

    protected $guarded = [
        'id'
    ];
}
