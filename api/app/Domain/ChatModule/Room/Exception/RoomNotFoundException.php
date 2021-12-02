<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Room\Exception;

use App\Core\Exception\BusinessLogicException;
use App\Core\Exception\ErrorCode;
use App\Domain\ChatModule\Room\ValueObject\RoomId;

class RoomNotFoundException extends BusinessLogicException
{
    public static function withId(RoomId $roomId): static
    {
        return new static(
            sprintf('Room with id "%s" not found.', $roomId->get()),
            ErrorCode::CHAT_ROOM_NOT_FOUND,
        );
    }
}
