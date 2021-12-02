<?php

declare(strict_types=1);

namespace App\Core\ValueObject;

use App\Core\ValueObject\Exception\InvalidIdException;

class Id extends ValueObject
{
    public const MIN_VALUE = 1;

    private int $id;

    /**
     * @throws InvalidIdException
     */
    protected function __construct(int $id)
    {
        if ($id < self::MIN_VALUE) {
            throw InvalidIdException::lessThanMin();
        }
        $this->id = $id;
    }

    /**
     * @throws InvalidIdException
     */
    public static function make(int $id): static
    {
        return new static($id);
    }

    public function get(): int
    {
        return $this->id;
    }
}
