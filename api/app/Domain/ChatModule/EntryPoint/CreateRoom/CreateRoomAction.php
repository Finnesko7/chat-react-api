<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\EntryPoint\CreateRoom;

use App\Core\Exception\InfrastructureException;
use App\Domain\ChatModule\Room\Exception\ChatRoomAlreadyExistsException;
use App\Domain\ChatModule\Room\Exception\InvalidChatRoomNameException;
use App\Domain\ChatModule\Room\Room;
use App\Domain\ChatModule\Room\RoomRepository;
use App\Domain\ChatModule\Room\ValueObject\RoomName;

class CreateRoomAction
{
    private RoomRepository $roomRepository;

    public function __construct(RoomRepository $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    /**
     * @throws InvalidChatRoomNameException
     * @throws ChatRoomAlreadyExistsException
     * @throws InfrastructureException
     */
    public function run(string $roomName): Room
    {
        $name = RoomName::make($roomName);
        $room = new Room($name);

        return $this->roomRepository->save($room);
    }
}
