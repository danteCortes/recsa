<?php

namespace App\Src\Domain\Auth\ValueObjects;

use InvalidArgumentException;

final class Email
{
    private function __construct(private readonly string $value){}

    public static function create(string $value): self {
        self::validate($value);
        return new self($value);
    }

    private static function validate(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Email cannot be empty');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Email $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
