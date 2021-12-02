<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Room\Exception;

use App\Core\Exception\BusinessLogicException;
use App\Core\Exception\ErrorCode;
use App\Domain\ChatModule\Room\ValueObject\RoomName;

class ChatRoomAlreadyExistsException extends BusinessLogicException
{
    public static function withSameName(RoomName $chatName): static
    {
        return new static(
            sprintf('Room with name "%s" already registered.', $chatName->get()),
            ErrorCode::CHAT_ROOM_ALREADY_EXIST,
        );
    }
}
