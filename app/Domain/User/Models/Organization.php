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

    protected $guarded = [
        'id'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function folders(): HasMany
    {
        return $this->hasMany(Folder::class);
    }

    public function rootFolder(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'root_folder_id');
    }

    public function screens(): HasMany
    {
        return $this->hasMany(Screen::class);
    }

    public function templates(): HasMany
    {
        return $this->hasMany(Template::class);
    }
}
