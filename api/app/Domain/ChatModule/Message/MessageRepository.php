<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Message;

use App\Core\Exception\InfrastructureException;

interface MessageRepository
{
    /**
     * @throws InfrastructureException
     */
    public function save(Message $message): Message;
}
