<?php

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    MongoDB\Laravel\MongoDBServiceProvider::class,
    App\Src\Infrastructure\Auth\Providers\AuthServiceProvider::class,
];
