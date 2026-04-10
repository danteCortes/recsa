<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\HandleInertiaRequests;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function(): void {
            foreach(glob(__DIR__ . '/../app/Src/Infrastructure/*/Routes/web.php') as $webRoute) {
                Route::middleware('web')->group($webRoute);
            }
            foreach(glob(__DIR__ . '/../app/Src/Infrastructure/*/Routes/api.php') as $apiRoute) {
                Route::middleware('api')->prefix('api')->group($apiRoute);
            }
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
