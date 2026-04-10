<?php

namespace App\Src\Infrastructure\Auth\Persistence\Implements;

use App\Src\Domain\Auth\Entities\Credentials;
use App\Src\Domain\Auth\Entities\AccessToken;
use App\Src\Domain\Auth\Entities\User;
use App\Src\Domain\Auth\ValueObjects\AuthId;
use App\Src\Domain\Auth\ValueObjects\Token;
use App\Src\Domain\Auth\ValueObjects\ExpireAt;
use App\Src\Domain\Auth\Repositories\AuthRepository;
use App\Src\Infrastructure\Auth\Persistence\Mappers\UserMapper;
use App\Src\Infrastructure\Auth\Persistence\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MongoDBAuthRepository implements AuthRepository
{
    public function login(Credentials $credentials): ?AccessToken
    {
        if(Auth::attempt([
            'email' => $credentials->email()->value(),
            'password' => $credentials->password()->value()
        ], $credentials->rememberMe())){
            
            $model = UserModel::where('email', $credentials->email()->value())->firstOrFail();

            $token = $model->createToken();

            return AccessToken::create(
                Token::create($token->plainTextToken),
                ExpireAt::create($token->accessToken->expires_at)
            );
        }

        throw ValidationException::withMessages([
            'email' => 'Credenciales inválidas',
        ]);
    }

    public function user(): ?User
    {
        $model = Auth::user();

        return $model ? UserMapper::toEntity($model) : null;
    }

    public function logout(): void
    {
        Auth::user()->tokens()->delete();
    }
}
