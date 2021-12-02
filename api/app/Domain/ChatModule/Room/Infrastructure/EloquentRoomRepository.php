<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Room\Infrastructure;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\InfrastructureException;
use App\Domain\ChatModule\Room\Exception\ChatRoomAlreadyExistsException;
use App\Domain\ChatModule\Room\Room;
use App\Domain\ChatModule\Room\RoomRepository;
use App\Domain\ChatModule\Room\ValueObject\RoomId;
use Illuminate\Database\QueryException;

class EloquentRoomRepository implements RoomRepository
{
    /**
     * @throws InfrastructureException
     */
    public function findById(RoomId $roomId): ?Room
    {
        try {
            $roomModel = RoomModel::where(RoomModel::ID_FIELD, '=', $roomId->get())
                ->first();
            $room = !is_null($roomModel) ? Room::fromEloquentModel($roomModel) : null;
        } catch (\Throwable $exception) {
            throw InfrastructureException::fromUnexpectedThrowable($exception);
        }

        return $room;
    }

    /**
     * @throws InfrastructureException
     * @throws ChatRoomAlreadyExistsException
     */
    public function save(Room $room): Room
    {
        try {
            $roomModel = $room->toEloquentModel();
            $roomModel->save();
        } catch (QueryException $queryException) {
            $errorCode = (int) $queryException->errorInfo[1];
            if ($errorCode === ErrorCode::ELOQUENT_DUPLICATE_ENTRY_ERROR) {
                throw ChatRoomAlreadyExistsException::withSameName($room->getName());
            } else {
                throw InfrastructureException::fromUnexpectedThrowable($queryException);
            }

        } catch (\Throwable $exception) {
            throw InfrastructureException::fromUnexpectedThrowable($exception);
        }

        return Room::fromEloquentModel($roomModel);
    }
}
