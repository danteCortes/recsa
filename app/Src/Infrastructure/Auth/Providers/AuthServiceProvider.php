<?php

namespace App\Src\Infrastructure\Auth\Providers;

use App\Src\Domain\Auth\Repositories\TokenAuthRepository;
use App\Src\Domain\Auth\Repositories\SessionAuthRepository;
use App\Src\Application\Auth\UseCases\Token\LoginUseCase as TokenLoginUseCase;
use App\Src\Application\Auth\UseCases\Token\UserUseCase as TokenUserUseCase;
use App\Src\Application\Auth\UseCases\Token\LogoutUseCase as TokenLogoutUseCase;
use App\Src\Application\Auth\UseCases\Session\LoginUseCase as SessionLoginUseCase;
use App\Src\Application\Auth\UseCases\Session\UserUseCase as SessionUserUseCase;
use App\Src\Application\Auth\UseCases\Session\LogoutUseCase as SessionLogoutUseCase;
use App\Src\Infrastructure\Auth\Persistence\Implements\MongoDBAuthRepository;
use App\Src\Infrastructure\Auth\Persistence\Implements\MongoDBSessionAuthRepository;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TokenAuthRepository::class, MongoDBAuthRepository::class);
        $this->app->bind(SessionAuthRepository::class, MongoDBSessionAuthRepository::class);
        $this->app->bind(TokenLoginUseCase::class, function($app){
            return TokenLoginUseCase::create($app->make(TokenAuthRepository::class));
        });
        $this->app->bind(TokenUserUseCase::class, function($app){
            return TokenUserUseCase::create($app->make(TokenAuthRepository::class));
        });
        $this->app->bind(TokenLogoutUseCase::class, function($app){
            return TokenLogoutUseCase::create($app->make(TokenAuthRepository::class));
        });
        $this->app->bind(SessionLoginUseCase::class, function($app){
            return SessionLoginUseCase::create($app->make(SessionAuthRepository::class));
        });
        $this->app->bind(SessionUserUseCase::class, function($app){
            return SessionUserUseCase::create($app->make(SessionAuthRepository::class));
        });
        $this->app->bind(SessionLogoutUseCase::class, function($app){
            return SessionLogoutUseCase::create($app->make(SessionAuthRepository::class));
        });
    }

    public function boot(): void
    {

    }
}