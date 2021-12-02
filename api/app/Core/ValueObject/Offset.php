<?php

declare(strict_types = 1);

namespace App\Core\ValueObject;

use App\Core\ValueObject\Exception\InvalidOffsetException;

class Offset extends ValueObject
{
    public const FIRST_PAGE_OFFSET = 0;

    private int $offset;

    public function __construct(int $offset)
    {
        if ($offset < self::FIRST_PAGE_OFFSET) {
            throw InvalidOffsetException::lessThanMin(self::FIRST_PAGE_OFFSET);
        }
        $this->offset = $offset;
    }

    public static function make(int $offset): self
    {
        return new self($offset);
    }

    public function get(): int
    {
        return $this->offset;
    }
}
