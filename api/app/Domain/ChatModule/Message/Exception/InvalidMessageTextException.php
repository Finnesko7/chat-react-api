<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Message\Exception;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\ValidationException;

class InvalidMessageTextException extends ValidationException
{
    public static function empty(): static
    {
        return new static('Chat message can\'t be empty.', ErrorCode::EMPTY_MESSAGE_TEXT);
    }

    public static function greaterThanMax(int $maxLength): static
    {
        return new static(
            sprintf('Chat message can\'t be greater than %s', $maxLength),
            ErrorCode::MESSAGE_TEXT_GREATER_THAN_MAX,
        );
    }
}
