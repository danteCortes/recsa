<?php

namespace App\Src\Application\Auth\Responses;

final class AccessTokenResponse
{
    private function __construct(
        public readonly string $token,
        public readonly string $expiresAt
    ){}

    public static function create(
        string $token,
        string $expiresAt
    ): self
    {
        return new self(
            $token,
            $expiresAt
        );
    }
}