<?php

namespace App\Src\Domain\Auth\Entities;

use App\Src\Domain\Auth\ValueObjects\Email;
use App\Src\Domain\Auth\ValueObjects\Name;
use App\Src\Domain\Auth\ValueObjects\UserId;

class User
{
    private function __construct(
        private readonly ?UserId $id,
        private readonly Email $email,
        private readonly Name $name
    ) {}

    public static function create(
        ?UserId $id,
        Email $email,
        Name $name
    ): self {
        return new self(
            $id,
            $email,
            $name
        );
    }

    public function id(): ?UserId
    {
        return $this->id;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function name(): Name
    {
        return $this->name;
    }
}