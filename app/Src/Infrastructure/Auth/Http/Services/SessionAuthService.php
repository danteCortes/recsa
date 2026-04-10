<?php

namespace App\Src\Infrastructure\Auth\Http\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Src\Application\Auth\UseCases\Session\LoginUseCase;
use App\Src\Application\Auth\UseCases\Session\UserUseCase;
use App\Src\Application\Auth\UseCases\Session\LogoutUseCase;
use App\Src\Application\Auth\DTOs\LoginDTO;
use App\Src\Infrastructure\Auth\Http\Requests\LoginRequest;

class SessionAuthService
{
    public function __construct(
        private readonly LoginUseCase $loginUseCase,
        private readonly UserUseCase $userUseCase,
        private readonly LogoutUseCase $logoutUseCase,
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $response = $this->loginUseCase->execute(
                LoginDTO::create(
                    $request->input('email'),
                    $request->input('password'),
                    $request->input('rememberMe', false)
                )
            );
            
            return response()->json($response);
        } catch (ValidationException $e) {
            throw $e;
        }
    }

    public function user(): JsonResponse
    {
        $response = $this->userUseCase->execute();

        return response()->json($response);
    }

    public function logout(): void
    {
        $this->logoutUseCase->execute();
    }
}
