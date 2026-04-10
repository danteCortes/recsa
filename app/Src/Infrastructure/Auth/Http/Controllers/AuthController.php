<?php

namespace App\Src\Infrastructure\Auth\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Src\Infrastructure\Auth\Http\Requests\LoginRequest;
use App\Src\Infrastructure\Auth\Http\Services\AuthService;

class AuthController
{
    public function __construct(
        private readonly AuthService $service,
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        return $this->service->login($request);
    }

    public function user(): JsonResponse
    {
        return $this->service->user();
    }

    public function logout(): JsonResponse
    {
        return $this->service->logout();
    }
}
