<?php

declare(strict_types=1);

namespace App\Core\ValueObject\Exception;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\ValidationException;

class InvalidEmailException extends ValidationException
{
    public static function emptyEmail(): static
    {
        return new static('Email can\'t be empty.', ErrorCode::EMPTY_EMAIL);
    }

    public static function invalidFormat(string $email): static
    {
        return new static(
            sprintf('Invalid email format. Got email "%s"', $email),
            ErrorCode::INVALID_EMAIL_FORMAT,
        );
    }
}
