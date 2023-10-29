<?php

namespace App\Domain\User\DataTransferObjects;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UserDTO extends Data
{
    public function __construct(
        public string|Optional $name,
        public string          $email,
        public string|Optional $password,
        public int|Optional    $organization_id
    )
    {
    }
}
