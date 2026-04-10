<?php

namespace App\Src\Application\Auth\DTOs;

final class LoginDTO
{
    private function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly bool $rememberMe
    ){}

    public static function create(
        string $email,
        string $password,
        bool $rememberMe
    ): self
    {
        return new self(
            $email,
            $password,
            $rememberMe
        );
    }
}