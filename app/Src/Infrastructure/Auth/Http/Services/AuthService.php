<?php

namespace App\Src\Infrastructure\Auth\Http\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
Use App\Src\Application\Auth\DTOs\LoginDTO;
use App\Src\Application\Auth\UseCases\LoginUseCase;
use App\Src\Application\Auth\UseCases\UserUseCase;
use App\Src\Application\Auth\UseCases\LogoutUseCase;
use App\Src\Infrastructure\Auth\Http\Requests\LoginRequest;

class AuthService
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

        return response()->json($response, 201);
    }

    public function logout(): JsonResponse
    {
        $response = $this->logoutUseCase->execute();

        return response()->json($response);
    }
}
