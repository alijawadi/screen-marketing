<?php

namespace Domain\User\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
