<?php

namespace App\Src\Application\Auth\UseCases\Token;

use App\Src\Domain\Auth\Entities\Auth;
use App\Src\Domain\Auth\Factories\CredentialsFactory;
use App\Src\Domain\Auth\Repositories\TokenAuthRepository;
Use App\Src\Application\Auth\DTOs\LoginDTO;
Use App\Src\Application\Auth\Responses\AccessTokenResponse;

class LoginUseCase
{
    private function __construct(
        private readonly TokenAuthRepository $repository,
    ) {}

    public static function create(TokenAuthRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(
        LoginDTO $dto
    ): AccessTokenResponse
    {
        $credentials = CredentialsFactory::fromPrimitives(
            $dto->email,
            $dto->password,
            $dto->rememberMe
        );

        $entity = $this->repository->login($credentials);

        return AccessTokenResponse::create(
            $entity->token()->value(),
            $entity->expireAt()->value()
        );
    }
}
