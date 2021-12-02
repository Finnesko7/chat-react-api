<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\EntryPoint\RoomMessagesList;

use App\Core\Collection\Collection;

class MessageInfoCollection extends Collection
{
    protected ?string $allowedType = MessageInfo::class;
}
