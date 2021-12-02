<?php

declare(strict_types=1);

namespace App\Core\ValueObject\Exception;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\ValidationException;

class InvalidPhoneNumberException extends ValidationException
{
    public static function emptyPhone(): static
    {
        return new static('Phone number can\'t be empty.', ErrorCode::EMPTY_PHONE);
    }

    public static function invalidFormat(string $phone): static
    {
        return new static(
            sprintf('Invalid phone format. Got phone "%s".', $phone),
            ErrorCode::INVALID_PHONE_FORMAT,
        );
    }
}
