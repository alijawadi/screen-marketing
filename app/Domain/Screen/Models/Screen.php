<?php

namespace Domain\Screen\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class Screen extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, AuditableTrait, HasUuid;

    protected $table = "screens";

    protected $fillable = [
        "uuid",
        "device_id",
        "organization_id",
        "name",
        "description",
        "tv_data",
    ];

    /**
     * The attributes that should be cast to native types.
     * integer, real, float, double, string, boolean, object, array,
     * collection, date, datetime, and timestamp
     *
     * @var array
     */
    protected $casts = [
        "uuid" => "string",
        "device_id" => "integer",
        "organization_id" => "integer",
        "name" => "string",
        "description" => "string",
        "tv_data" => "object",
    ];

    protected $dates = [
        "created_at",
        "updated_at",
    ];


    protected $guarded = [
        "id"
    ];

    protected function tvData(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value, true),
            set: fn($value) => json_encode($value),
        );
    }
}
