<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\EntryPoint\RoomList;

class RoomInfo
{
    private int $roomId;
    private string $roomName;
    private string $lastMessageTime;

    public function __construct(int $roomId, string $roomName, string $lastMessageTime)
    {
        $this->roomId = $roomId;
        $this->roomName = $roomName;
        $this->lastMessageTime = $lastMessageTime;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getRoomName(): string
    {
        return $this->roomName;
    }

    public function getLastMessageTime(): string
    {
        return $this->lastMessageTime;
    }
}
