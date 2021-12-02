<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Message\ValueObject;

use App\Core\ValueObject\ValueObject;
use App\Domain\ChatModule\Message\Exception\InvalidMessageTextException;

class Text extends ValueObject
{
    private const MAX_LENGTH = 240;

    private string $text;

    /**
     * @throws InvalidMessageTextException
     */
    private function __construct(string $text)
    {
        if ('' === $text) {
            throw InvalidMessageTextException::empty();
        }
        $textLength = mb_strlen($text);
        if ($textLength > self::MAX_LENGTH) {
            throw InvalidMessageTextException::greaterThanMax(self::MAX_LENGTH);
        }
        $this->text = $text;
    }

    /**
     * @throws InvalidMessageTextException
     */
    public static function make(string $text): static
    {
        return new static($text);
    }

    public function get(): string
    {
        return $this->text;
    }
}
