<?php

namespace App\Src\Application\Auth\UseCases\Token;

use App\Src\Domain\Auth\Repositories\TokenAuthRepository;
use App\Src\Application\Auth\Responses\UserResponse;

class UserUseCase
{
    private function __construct(
        private readonly TokenAuthRepository $repository,
    ) {}

    public static function create(TokenAuthRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(): UserResponse {
        $entity = $this->repository->user();

        return UserResponse::create(
            $entity->userId()->value(),
            $entity->name()->value(),
            $entity->email()->value(),
        );
    }
}
