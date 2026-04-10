<?php

namespace App\Src\Application\Auth\Responses;

final class UserResponse
{
    private function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $email,
    ){}

    public static function create(
        string $id,
        string $name,
        string $email,
    ): self
    {
        return new self(
            $id,
            $name,
            $email
        );
    }
}