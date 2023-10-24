<?php

namespace Domain\Screen\Models;

use Domain\User\Models\Organization;
use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        "organization_id",//nullable
        "created_by",//nullable
        "updated_by",//nullable
        "uuid",
        "device_id",//nullable
        "name",//nullable
        "description",//nullable
        "tv_data",//nullable
        "setting",//nullable
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
        "uuid" => "string",
        "device_id" => "string",
        "name" => "string",
        "description" => "string",
        "tv_data" => "object",
        "setting" => "object",
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
