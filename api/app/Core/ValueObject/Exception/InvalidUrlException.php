<?php

declare(strict_types=1);

namespace App\Core\ValueObject\Exception;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\ValidationException;

class InvalidUrlException extends ValidationException
{
    public static function emptyUrl(): static
    {
        return new static('Url can\'t be empty.', ErrorCode::EMPTY_URL);
    }

    public static function invalidFormat(string $url): static
    {
        return new static(
            sprintf('Invalid url format. Got url "%s".', $url),
            ErrorCode::INVALID_URL_FORMAT,
        );
    }
}
