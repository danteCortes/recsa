<?php

namespace App\Src\Application\Auth\UseCases\Token;

use App\Src\Domain\Auth\Repositories\AuthRepository;

class LogoutUseCase
{
    private function __construct(
        private readonly AuthRepository $repository,
    ) {}

    public static function create(AuthRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(): void {
        $this->repository->logout();
    }
}
