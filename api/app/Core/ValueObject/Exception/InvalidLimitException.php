<?php

declare(strict_types = 1);

namespace App\Core\ValueObject\Exception;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\ValidationException;

class InvalidLimitException extends ValidationException
{
    public static function lessThanMin(int $minValue): static
    {
        return new static(
            sprintf('Limit can\'t be less than %s', $minValue),
            ErrorCode::LIMIT_LESS_THAN_MIN,
        );
    }
}
