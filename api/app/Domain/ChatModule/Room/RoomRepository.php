<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Room;

use App\Core\Exception\InfrastructureException;
use App\Domain\ChatModule\Room\Exception\ChatRoomAlreadyExistsException;
use App\Domain\ChatModule\Room\ValueObject\RoomId;

interface RoomRepository
{
    /**
     * @throws InfrastructureException
     */
    public function findById(RoomId $roomId): ?Room;

    /**
     * @throws InfrastructureException
     * @throws ChatRoomAlreadyExistsException
     */
    public function save(Room $room): Room;
}
