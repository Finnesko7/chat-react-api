<?php

declare(strict_types=1);

namespace App\Core\Exception;

class NotAllowedCollectionItemException extends ValidationException
{
    public static function collectionCantContainItem(string $collectionName, string $allowedType, $item) : static
    {
        $givenType = is_object($item) ? get_class($item) : gettype($item);
        $messagePattern = 'The collection %s can only contain %s. Given: %s';

        return new static(
            sprintf($messagePattern, $collectionName, $allowedType, $givenType),
            ErrorCode::INTERNAL_ERROR,
        );
    }
}
