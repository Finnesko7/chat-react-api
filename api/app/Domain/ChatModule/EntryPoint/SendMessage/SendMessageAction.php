<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\EntryPoint\SendMessage;

use App\Core\Exception\InfrastructureException;
use App\Core\ValueObject\Exception\InvalidIdException;
use App\Domain\ChatModule\EntryPoint\RoomMessagesList\MessageInfo;
use App\Domain\ChatModule\Message\Event\MessageWasSend;
use App\Domain\ChatModule\Message\Exception\InvalidMessageTextException;
use App\Domain\ChatModule\Message\Message;
use App\Domain\ChatModule\Message\MessageRepository;
use App\Domain\ChatModule\Message\ValueObject\Text;
use App\Domain\ChatModule\Room\Exception\RoomNotFoundException;
use App\Domain\ChatModule\Room\RoomRepository;
use App\Domain\ChatModule\Room\ValueObject\RoomId;
use App\Domain\ChatModule\User\ChatUserRepository;
use App\Domain\ChatModule\User\Exception\ChatUserNotFoundException;
use App\Domain\ChatModule\User\ValueObject\UserId;

class SendMessageAction
{
    private ChatUserRepository $chatUserRepository;
    private MessageRepository $messageRepository;
    private RoomRepository $roomRepository;

    public function __construct(
        ChatUserRepository $chatUserRepository,
        MessageRepository $messageRepository,
        RoomRepository $roomRepository,
    ) {
        $this->chatUserRepository = $chatUserRepository;
        $this->messageRepository = $messageRepository;
        $this->roomRepository = $roomRepository;
    }

    /**
     * @throws InvalidIdException
     * @throws InvalidMessageTextException
     * @throws RoomNotFoundException
     * @throws InfrastructureException
     */
    public function run(SendMessageParameters $sendMessageParameters): MessageInfo
    {
        $roomId = RoomId::make($sendMessageParameters->getRoomId());
        $senderId = UserId::make($sendMessageParameters->getUserId());
        $text = Text::make($sendMessageParameters->getText());
        $sender = $this->chatUserRepository->findByUserId($senderId);

        if (is_null($sender)) {
            throw ChatUserNotFoundException::withUserId($senderId);
        }

        $room = $this->roomRepository->findById($roomId);

        if (is_null($room)) {
            throw RoomNotFoundException::withId($roomId);
        }

        $message = $this->messageRepository->save(new Message($roomId, $sender->getId(), $text));

        $messageInfo = new MessageInfo(
            $sender->getNickname()->get(),
            $text->get(),
            $message->getSendTime()->format('Y-m-d H:i:s'),
        );

        MessageWasSend::dispatch(
            $roomId->get(),
            $messageInfo->getAuthorName(),
            $messageInfo->getText(),
            $messageInfo->getSendTime(),
            $senderId->get()
        );

        return $messageInfo;
    }
}
