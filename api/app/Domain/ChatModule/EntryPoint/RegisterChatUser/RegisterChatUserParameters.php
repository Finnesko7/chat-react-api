<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\EntryPoint\RegisterChatUser;

class RegisterChatUserParameters
{
    private int $userId;
    private string $nickname;

    public function __construct(int $userId, string $nickname)
    {
        $this->userId = $userId;
        $this->nickname = $nickname;
    }

    public function getUserId() : int
    {
        return $this->userId;
    }

    public function getNickname() : string
    {
        return $this->nickname;
    }
}
