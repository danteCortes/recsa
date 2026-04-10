<?php

namespace App\Src\Domain\Auth\Factories;

use App\Src\Domain\Auth\Entities\User;
use App\Src\Domain\Auth\ValueObjects\Email;
use App\Src\Domain\Auth\ValueObjects\Name;
use App\Src\Domain\Auth\ValueObjects\UserId;

class UserFactory
{
    public static function fromPrimitives(
        string $id,
        string $name,
        string $email,
    ): User
    {
        return User::create(
            UserId::create($id),
            Name::create($name),
            Email::create($email)
        );
    }
}