<?php

namespace App\Src\Domain\Auth\Factories;

use App\Src\Domain\Auth\Entities\Credentials;
use App\Src\Domain\Auth\ValueObjects\Email;
use App\Src\Domain\Auth\ValueObjects\Password;
use App\Src\Domain\Auth\Enums\RememberMe;

class CredentialsFactory
{
    public static function fromPrimitives(
        string $email,
        string $password,
        bool $rememberMe
    ): Credentials
    {
        return Credentials::create(
            Email::create($email),
            Password::create($password),
            $rememberMe ? RememberMe::YES : RememberMe::NO
        );
    }
}