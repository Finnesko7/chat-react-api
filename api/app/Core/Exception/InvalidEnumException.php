<?php

declare(strict_types=1);

namespace App\Core\Exception;

class InvalidEnumException extends ValidationException
{
    public static function notInList(string|int $gotEnum, array $enumList): static
    {
        $message = sprintf(
            'Got value "%s" not isset in enum list. Allowed values: %s',
            $gotEnum,
            implode(', ', $enumList),
        );

        return new static($message, ErrorCode::INTERNAL_ERROR);
    }

    public static function undefinedEnumConstant(string $gotConstant, array $constantList): static
    {
        $message = sprintf(
            'Got constant "%s" not found in enum. Isset constants: %s',
            $gotConstant,
            implode(', ', $constantList),
        );

        return new static($message, ErrorCode::INTERNAL_ERROR);
    }
}
