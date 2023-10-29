<?php

namespace App\Domain\Media\DataTransferObjects;

use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class StoreMediaDTO extends Data
{
    public function __construct(
        public string $file,
        public int    $folder_id
    ){}
}
