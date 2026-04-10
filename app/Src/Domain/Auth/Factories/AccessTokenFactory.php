<?php

namespace App\Src\Domain\Auth\Factories;

use App\Src\Domain\Auth\Entities\AccessToken;
use App\Src\Domain\Auth\ValueObjects\ExpiresAt;
use App\Src\Domain\Auth\ValueObjects\Token;

class AccessTokenFactory
{
    public static function fromPrimitives(
        string $token,
        string $expiresAt,
    ): AccessToken
    {
        return AccessToken::create(
            Token::create($token),
            ExpiresAt::create($expiresAt)
        );
    }
}