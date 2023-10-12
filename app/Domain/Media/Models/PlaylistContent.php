<?php

namespace App\Domain\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistContent extends Model
{
    use HasFactory;

    protected $guarded = [
        "id"
    ];
}
