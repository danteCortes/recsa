<?php

use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [\App\Src\Infrastructure\Auth\Http\Controllers\AuthController::class, 'login']);
Route::get('/auth/user', [\App\Src\Infrastructure\Auth\Http\Controllers\AuthController::class, 'user'])->middleware('auth:sanctum');
Route::post('/auth/logout', [\App\Src\Infrastructure\Auth\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:sanctum');
