<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Room;

use App\Domain\ChatModule\Room\Infrastructure\RoomModel;
use App\Domain\ChatModule\Room\ValueObject\RoomId;
use App\Domain\ChatModule\Room\ValueObject\RoomName;

class Room
{
    private ?RoomId $id = null;
    private RoomName $name;

    public function __construct(RoomName $name)
    {
        $this->name = $name;
    }

    public static function fromEloquentModel(RoomModel $roomModel): static
    {
        $room = new static(RoomName::make($roomModel->{RoomModel::NAME_FIELD}));
        $room->id = RoomId::make((int) $roomModel->{RoomModel::ID_FIELD});

        return $room;
    }

    public function toEloquentModel(): RoomModel
    {
        $roomModel = new RoomModel();
        $roomModel->{RoomModel::NAME_FIELD} = $this->name->get();
        if (!is_null($this->id)) {
            $roomModel->{RoomModel::ID_FIELD} = $this->id->get();
        }

        return $roomModel;
    }

    public function getId() : ?RoomId
    {
        return $this->id;
    }

    public function getName() : RoomName
    {
        return $this->name;
    }
}
