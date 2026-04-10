<?php

namespace App\Src\Infrastructure\Auth\Persistence\Implements;

use App\Src\Domain\Auth\Entities\User;
use App\Src\Domain\Auth\Entities\Credentials;
use App\Src\Domain\Auth\Repositories\SessionAuthRepository;
use App\Src\Infrastructure\Auth\Persistence\Mappers\UserMapper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MongoDBSessionAuthRepository implements SessionAuthRepository
{
    public function login(Credentials $entity): User
    {
        if(Auth::attempt([
            'email' => $entity->email()->value(),
            'password' => $entity->password()->value()
        ], $entity->rememberMe())){
            
            request()->session()->regenerate();
            
            $model = Auth::user();

            return UserMapper::toEntity($model);
        }

        throw ValidationException::withMessages([
            'email' => 'Credenciales inválidas',
        ]);
    }

    public function user(): ?User
    {
        $model = Auth::user();

        return UserMapper::toEntity($model);
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();
    
        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    }
}
