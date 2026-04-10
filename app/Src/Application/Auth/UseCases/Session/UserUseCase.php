<?php

namespace App\Src\Application\Auth\UseCases\Session;

use App\Src\Domain\Auth\Entities\Auth;
use App\Src\Domain\Auth\Repositories\SessionAuthRepository;
use App\Src\Application\Auth\Responses\UserResponse;

class UserUseCase
{
    private function __construct(
        private readonly SessionAuthRepository $repository,
    ) {}

    public static function create(SessionAuthRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(): ?UserResponse {
        $entity = $this->repository->user();

        if(!$entity) return null;

        return UserResponse::create(
            $entity->id()?->value(),
            $entity->name()->value(),
            $entity->email()->value(),
        );
    }
}
