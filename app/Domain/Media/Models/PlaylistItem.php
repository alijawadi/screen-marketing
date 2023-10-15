<?php

namespace App\Domain\Media\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaylistItem extends Model
{
    use HasFactory;

    protected $guarded = [
        "id"
    ];
}
