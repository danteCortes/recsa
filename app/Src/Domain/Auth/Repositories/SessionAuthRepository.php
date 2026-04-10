<?php

namespace App\Src\Domain\Auth\Repositories;

use App\Src\Domain\Auth\Entities\Credentials;
use App\Src\Domain\Auth\Entities\User;

interface SessionAuthRepository
{
    public function login(Credentials $credentials): User;

    public function user(): ?User;

    public function logout(): void;
}