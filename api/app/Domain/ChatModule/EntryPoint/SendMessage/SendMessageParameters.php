<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\EntryPoint\SendMessage;

class SendMessageParameters
{
    private int $roomId;
    private int $userId;
    private string $text;

    public function __construct(int $roomId, int $userId, string $text)
    {
        $this->roomId = $roomId;
        $this->userId = $userId;
        $this->text = $text;
    }

    public function getRoomId() : int
    {
        return $this->roomId;
    }

    public function getUserId() : int
    {
        return $this->userId;
    }

    public function getText() : string
    {
        return $this->text;
    }
}
