<?php

declare(strict_types = 1);

namespace App\Core\ValueObject;

use App\Core\ValueObject\Exception\InvalidLimitException;

class Limit extends ValueObject
{
    public const ONE_RECORD = 1;

    public const DEFAULT_LIMIT = 500;

    private int $limit;

    public function __construct(int $limit)
    {
        if ($limit < self::ONE_RECORD) {
            throw InvalidLimitException::lessThanMin(self::ONE_RECORD);
        }
        $this->limit = $limit;
    }

    public static function make(int $limit): self
    {
        return new self($limit);
    }

    public function get(): int
    {
        return $this->limit;
    }
}
