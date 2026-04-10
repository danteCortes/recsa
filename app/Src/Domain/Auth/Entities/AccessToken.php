<?php

namespace App\Src\Domain\Auth\Entities;

use App\Src\Domain\Auth\ValueObjects\Token;
use App\Src\Domain\Auth\ValueObjects\ExpireAt;

class AccessToken
{
    private function __construct(
        private readonly Token $token,
        private readonly ExpireAt $expireAt
    ) {}

    public static function create(
        Token $token,
        ExpireAt $expireAt
    ): self {
        return new self(
            $token,
            $expireAt
        );
    }

    public function token(): Token
    {
        return $this->token;
    }

    public function expireAt(): ExpireAt
    {
        return $this->expireAt;
    }

    public function isExpired(): bool
    {
        return $this->expireAt->isExpired();
    }
}