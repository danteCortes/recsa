<?php

namespace App\Src\Application\Auth\UseCases\Session;

use App\Src\Domain\Auth\Entities\Auth;
use App\Src\Domain\Auth\Repositories\SessionAuthRepository;
use App\Src\Domain\Auth\Factories\CredentialsFactory;
use App\Src\Application\Auth\DTOs\LoginDTO;
use App\Src\Application\Auth\Responses\UserResponse;

class LoginUseCase
{
    private function __construct(
        private readonly SessionAuthRepository $repository,
    ) {}

    public static function create(SessionAuthRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(
        LoginDTO $dto
    ): UserResponse {
        $entity = $this->repository->login(
            CredentialsFactory::fromPrimitives(
                $dto->email,
                $dto->password,
                $dto->rememberMe
            )
        );

        return UserResponse::create(
            $entity->id()?->value(),
            $entity->name()->value(),
            $entity->email()->value()
        );
    }
}
