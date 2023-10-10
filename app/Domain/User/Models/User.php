<?php

namespace Domain\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domain\User\DataTransferObjects\UserDTO;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use \OwenIt\Auditing\Auditable as AuditableTrait;
use Spatie\LaravelData\WithData;
use Spatie\MediaLibrary\MediaCollections\Models\Concerns\HasUuid;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, AuditableTrait, WithData, HasUuid;

    protected string $dataClass = UserDTO::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
