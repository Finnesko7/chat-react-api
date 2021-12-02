<?php

declare(strict_types=1);

namespace App\Core\ValueObject\Exception;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\ValidationException;

class InvalidTokenException extends ValidationException
{
    public static function emptyToken(): static
    {
        return new static('Token can\'t be empty.', ErrorCode::EMPTY_TOKEN);
    }
}
