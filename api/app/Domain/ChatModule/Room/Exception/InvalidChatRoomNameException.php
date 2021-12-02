<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Room\Exception;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\ValidationException;

class InvalidChatRoomNameException extends ValidationException
{
    public static function empty(): static
    {
        return new static('Chat room name can\'t be empty.', ErrorCode::EMPTY_CHAT_ROOM_NAME);
    }

    public static function lessThanMin(int $minLength): static
    {
        return new static(
            sprintf('Chat room name can\'t be less than %s', $minLength),
            ErrorCode::CHAT_ROOM_NAME_LESS_THAN_MIN,
        );
    }

    public static function greaterThanMax(int $maxLength): static
    {
        return new static(
            sprintf('Chat room name can\'t be greater than %s', $maxLength),
            ErrorCode::CHAT_ROOM_NAME_GREATER_THAN_MAX,
        );
    }
}
