<?php

namespace Domain\User\Models;

use App\Domain\Media\Models\Folder;
use App\Domain\Media\Models\Template;
use Domain\Screen\Models\Screen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use \OwenIt\Auditing\Auditable as AuditableTrait;

class Organization extends Model implements Auditable
{
    use HasFactory, AuditableTrait;

    protected $table = "organizations";

    protected $fillable = [
        "owner_id",
        "name",
        "description",//nullable
    ];

    /**
     * The attributes that should be cast to native types.
     * integer, real, float, double, string, boolean, object, array,
     * collection, date, datetime, and timestamp
     *
     * @var array
     */
    protected $casts = [
        "owner_id" => "integer",
        "name" => "string",
        "description" => "string",
    ];

    protected $dates = [
        "created_at",
        "updated_at",
        "deleted_at",
    ];

    protected $guarded = [
        'id'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, "owner_id");
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, "organization_id", "id");
    }

    public function folders(): HasMany
    {
        return $this->hasMany(Folder::class, "organization_id", "id");
    }

    public function templates(): HasMany
    {
        return $this->hasMany(Template::class, "organization_id", "id");
    }

    public function screens(): HasMany
    {
        return $this->hasMany(Screen::class, "organization_id", "id");
    }

}
