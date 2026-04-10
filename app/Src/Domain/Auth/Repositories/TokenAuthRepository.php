<?php

namespace App\Src\Domain\Auth\Repositories;

use App\Src\Domain\Auth\Domain\Entities\Credentials;
use App\Src\Domain\Auth\Domain\Entities\User;
use App\Src\Domain\Auth\Domain\Entities\AccessToken;

interface TokenAuthRepository
{
    public function login(Credentials $credentials): AccessToken;

    public function user(): ?User;

    public function logout(): void;
}