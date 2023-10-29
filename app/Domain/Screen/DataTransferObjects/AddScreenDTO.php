<?php

namespace App\Domain\Screen\DataTransferObjects;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class AddScreenDTO extends Data
{
    public function __construct(
        public string  $code,
        public int     $organization_id
    ){}
}
