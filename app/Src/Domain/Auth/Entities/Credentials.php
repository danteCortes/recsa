<?php

namespace App\Src\Domain\Auth\Entities;

use App\Src\Domain\Auth\ValueObjects\Email;
use App\Src\Domain\Auth\ValueObjects\Password;
use App\Src\Domain\Auth\Enums\RememberMe;

class Credentials
{
    private function __construct(
        private readonly Email $email,
        private readonly Password $password,
        private readonly RememberMe $rememberMe
    ) {}

    public static function create(
        Email $email,
        Password $password,
        RememberMe $rememberMe
    ): self {
        return new self(
            $email,
            $password,
            $rememberMe
        );
    }
    
    public function email(): Email
    {
        return $this->email;
    }

    public function password(): Password
    {
        return $this->password;
    }

    public function rememberMe(): bool
    {
        return $this->rememberMe->isPositive();
    }
}