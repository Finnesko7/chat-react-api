<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\User\Exception;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\ValidationException;

class InvalidNicknameException extends ValidationException
{
    public static function empty(): static
    {
        return new static('Chat nickname can\'t be empty.', ErrorCode::EMPTY_NICKNAME);
    }

    public static function lessThanMin(int $minLength): static
    {
        return new static(
            sprintf('Chat nickname can\'t be less than %s', $minLength),
            ErrorCode::NICKNAME_LESS_THAN_MIN,
        );
    }

    public static function greaterThanMax(int $maxLength): static
    {
        return new static(
            sprintf('Chat nickname can\'t be greater than %s', $maxLength),
            ErrorCode::NICKNAME_GREATER_THAN_MAX,
        );
    }
}
