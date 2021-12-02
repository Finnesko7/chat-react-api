<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Room\ValueObject;

use App\Core\ValueObject\ValueObject;
use App\Domain\ChatModule\Room\Exception\InvalidChatRoomNameException;

class RoomName extends ValueObject
{
    private const MIN_LENGTH = 2;
    private const MAX_LENGTH = 64;

    private string $roomName;

    /**
     * @throws InvalidChatRoomNameException
     */
    private function __construct(string $roomName)
    {
        if ('' === $roomName) {
            throw InvalidChatRoomNameException::empty();
        }
        $roomNameLength = mb_strlen($roomName);
        if ($roomNameLength < self::MIN_LENGTH) {
            throw InvalidChatRoomNameException::lessThanMin(self::MIN_LENGTH);
        }
        if ($roomNameLength > self::MAX_LENGTH) {
            throw InvalidChatRoomNameException::greaterThanMax(self::MAX_LENGTH);
        }
        $this->roomName = $roomName;
    }

    /**
     * @throws InvalidChatRoomNameException
     */
    public static function make(string $roomName): static
    {
        return new static($roomName);
    }

    public function get(): string
    {
        return $this->roomName;
    }
}
