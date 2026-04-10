<?php

namespace App\Src\Infrastructure\Auth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Src\Infrastructure\Auth\Http\Requests\LoginRequest;
use App\Src\Infrastructure\Auth\Http\Services\SessionAuthService;

class SessionAuthController
{
    public function __construct(
        private readonly SessionAuthService $service,
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        return $this->service->login($request);
    }

    public function user(): JsonResponse
    {
        return $this->service->user();
    }

    public function logout(): void
    {
        $this->service->logout();
    }
}