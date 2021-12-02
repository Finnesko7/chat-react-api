<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Message;

use App\Domain\ChatModule\Message\Infrastructure\MessageModel;
use App\Domain\ChatModule\Message\ValueObject\MessageId;
use App\Domain\ChatModule\Message\ValueObject\Text;
use App\Domain\ChatModule\Room\ValueObject\RoomId;
use App\Domain\ChatModule\User\ValueObject\ChatUserId;

class Message
{
    private ?MessageId $id = null;
    private RoomId $roomId;
    private ChatUserId $senderId;
    private Text $text;
    private \DateTimeImmutable $sendTime;

    public function __construct(RoomId $roomId, ChatUserId $senderId, Text $text)
    {
        $this->roomId = $roomId;
        $this->senderId = $senderId;
        $this->text = $text;
        $this->sendTime = new \DateTimeImmutable();
    }

    public static function fromEloquentModel(MessageModel $messageModel): static
    {
        $message = new static(
            RoomId::make((int) $messageModel->{MessageModel::CHAT_ROOM_ID_FIELD}),
            ChatUserId::make((int) $messageModel->{MessageModel::CHAT_USER_ID_FIELD}),
            Text::make($messageModel->{MessageModel::TEXT_FIELD})
        );
        $message->id = MessageId::make((int) $messageModel->{MessageModel::ID_FIELD});
        $message->sendTime = $messageModel->{MessageModel::SEND_TIME} instanceof \DateTimeImmutable
            ? $messageModel->{MessageModel::SEND_TIME}
            : new \DateTimeImmutable($messageModel->{MessageModel::SEND_TIME});

        return $message;
    }

    public function toEloquentModel(): MessageModel
    {
        $messageModel = new MessageModel();
        $messageModel->{MessageModel::CHAT_ROOM_ID_FIELD} = $this->roomId->get();
        $messageModel->{MessageModel::CHAT_USER_ID_FIELD} = $this->senderId->get();
        $messageModel->{MessageModel::TEXT_FIELD} = $this->text->get();
        $messageModel->{MessageModel::SEND_TIME} = $this->sendTime;
        if (!is_null($this->id)) {
            $messageModel->{MessageModel::ID_FIELD} = $this->id->get();
        }

        return $messageModel;
    }

    public function getId() : ?MessageId
    {
        return $this->id;
    }

    public function getRoomId() : RoomId
    {
        return $this->roomId;
    }

    public function getSenderId() : ChatUserId
    {
        return $this->senderId;
    }

    public function getText() : Text
    {
        return $this->text;
    }

    public function getSendTime() : \DateTimeImmutable
    {
        return $this->sendTime;
    }
}
