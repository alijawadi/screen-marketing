<?php

namespace Domain\Screen\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PairingCode extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
}
