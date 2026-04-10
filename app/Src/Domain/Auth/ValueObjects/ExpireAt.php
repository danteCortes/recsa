<?php

namespace App\Src\Domain\Auth\ValueObjects;

use InvalidArgumentException;
use DateTimeImmutable;

final class ExpireAt
{
    private function __construct(private readonly string $value){}

    public static function create(string $value): self {
        self::validate($value);
        return new self($value);
    }

    private static function validate(string $value): void
    {
        $parsed = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $value);
        if (!$parsed || $parsed->format('Y-m-d H:i:s') !== $value) {
            throw new InvalidArgumentException('ExpireAt invalid format. Expected format: Y-m-d H:i:s');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ExpireAt $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return $this->value->format('Y-m-d H:i:s');
    }

    public function isExpired(): bool
    {
        return $this->value < new DateTimeImmutable();
    }
}
