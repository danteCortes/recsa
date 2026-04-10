<?php

namespace App\Src\Infrastructure\Auth\Persistence\Mappers;

use App\Src\Domain\Auth\Entities\User;
use App\Src\Domain\Auth\ValueObjects\UserId;
use App\Src\Domain\Auth\ValueObjects\Email;
use App\Src\Domain\Auth\ValueObjects\Name;
use App\Src\Infrastructure\Auth\Persistence\Models\UserModel;

final class UserMapper
{
    public static function toModel(User $entity): UserModel
    {
        $data = [
            'name' => $entity->name()->value(),
            'email' => $entity->email()->value(),
        ];

        return $entity->userId() ? UserModel([
            'id' => $entity->userId()->value(),
            ...$data
        ]) : UserModel($data);
    }
    
    public static function toEntity(UserModel $model): User
    {
        return User::create(
            $model->id ? UserId::create($model->id) : null,
            Email::create($model->email),
            Name::create($model->name),
        );
    }
}