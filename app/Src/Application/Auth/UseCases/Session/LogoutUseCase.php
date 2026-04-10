<?php

namespace App\Src\Application\Auth\UseCases\Session;

use App\Src\Domain\Auth\Entities\Auth;
use App\Src\Domain\Auth\Repositories\SessionAuthRepository;

class LogoutUseCase
{
    private function __construct(
        private readonly SessionAuthRepository $repository,
    ) {}

    public static function create(SessionAuthRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(): void {
        
        $this->repository->logout();
    }
}
