<?php

declare(strict_types=1);

namespace App\Core\ValueObject\Exception;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\ValidationException;
use App\Core\ValueObject\Id;

class InvalidIdException extends ValidationException
{
    public static function lessThanMin(): static
    {
        return new static(
            sprintf('Id can\'t be less than %s', Id::MIN_VALUE),
            ErrorCode::ID_LESS_THAN_MIN,
        );
    }
}
