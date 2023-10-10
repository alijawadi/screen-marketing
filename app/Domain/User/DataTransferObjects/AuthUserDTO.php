<?php

namespace App\Domain\User\DataTransferObjects;

class AuthUserDTO extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string $token
    )
    {
    }


    public static function fromString(string $token): self
    {
        return new self($token);
    }
}
