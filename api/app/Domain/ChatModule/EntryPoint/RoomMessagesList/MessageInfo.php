<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\EntryPoint\RoomMessagesList;

class MessageInfo
{
    private string $authorName;
    private string $text;
    private string $sendTime;

    public function __construct(string $authorName, string $text, string $sendTime)
    {
        $this->authorName = $authorName;
        $this->text = $text;
        $this->sendTime = $sendTime;
    }

    public function getAuthorName() : string
    {
        return $this->authorName;
    }

    public function getText() : string
    {
        return $this->text;
    }

    public function getSendTime() : string
    {
        return $this->sendTime;
    }
}
