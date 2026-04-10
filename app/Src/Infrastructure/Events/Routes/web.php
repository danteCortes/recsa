<?php

use Illuminate\Support\Facades\Route;

Route::get('/event', function () {
    return Inertia('event/pages/Index');
})->middleware('auth:sanctum');
