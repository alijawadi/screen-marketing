<?php

namespace Domain\User\Models;

use App\Domain\Media\Models\Folder;
use App\Domain\Media\Models\Canvas;
use App\Domain\User\DataTransferObjects\UserDTO;
use Domain\Screen\Models\Screen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    protected $table = "users";

    protected $fillable = [
        "parent_id",//nullable
        "organization_id",//nullable
        "uuid",
        "name",
        "email",
        "password",
        "roles",
        "accesses",
        "email_verified_at",//nullable
        "is_organization_owner",
        "is_active",// active and de-active children
    ];

    /**
     * The attributes that should be cast to native types.
     * integer, real, float, double, string, boolean, object, array,
     * collection, date, datetime, and timestamp
     *
     * @var array
     */
    protected $casts = [
        "parent_id" => "integer",
        "organization_id" => "integer",
        "uuid" => "string",
        "name" => "string",
        "email" => "integer",
        'password' => 'hashed',
        'roles' => 'object',
        'accesses' => 'object',
        'email_verified_at' => 'datetime',
        'is_organization_owner' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        "created_at",
        "updated_at",
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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];


    protected string $dataClass = UserDTO::class;


    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, "parent_id");
    }

    public function team(): HasMany
    {
        return $this->hasMany(User::class, "parent_id", "id");
    }

    public function createdTemplates(): HasMany
    {
        return $this->hasMany(Canvas::class, "created_by", "id");
    }

    public function updatedTemplates(): HasMany
    {
        return $this->hasMany(Canvas::class, "updated_by", "id");
    }

    public function createdScreens(): HasMany
    {
        return $this->hasMany(Screen::class, "created_by", "id");
    }

    public function updatedScreens(): HasMany
    {
        return $this->hasMany(Screen::class, "updated_by", "id");
    }

    public function createdFolders(): HasMany
    {
        return $this->hasMany(Folder::class, "created_by", "id");
    }

    public function updatedFolders(): HasMany
    {
        return $this->hasMany(Folder::class, "updated_by", "id");
    }

    public function mainOrganization(): HasOne
    {
        return $this->hasOne(Organization::class, "owner_id", "id");
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, "organization_id");
    }


}
