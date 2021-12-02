<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\EntryPoint\RoomList;

use App\Core\Collection\Collection;

class RoomInfoCollection extends Collection
{
    protected ?string $allowedType = RoomInfo::class;
}
