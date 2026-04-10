<?php

use Illuminate\Support\Facades\Route;
use App\Src\Infrastructure\Auth\Http\Controllers\SessionAuthController;

Route::get('/', function () {
    return Inertia('auth/pages/Index');
})->name('login');
Route::group(['prefix' => 'auth'], function(){
    Route::post('/login', [SessionAuthController::class, 'login']);
    Route::get('/user', [SessionAuthController::class, 'user'])->middleware('auth:sanctum');
    Route::post('/logout', [SessionAuthController::class, 'logout'])->middleware('auth:sanctum');
});
