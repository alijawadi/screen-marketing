<?php

namespace App\Domain\User\DataTransferObjects;

use Spatie\LaravelData\Data;

class AuthUserDTO extends Data
{
    public function __construct(
        public string $token
    )
    {
    }


//    public static function fromString(string $token): self
//    {
//        return new self($token);
//    }
}
