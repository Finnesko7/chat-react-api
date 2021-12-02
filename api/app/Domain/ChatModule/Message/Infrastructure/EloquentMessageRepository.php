<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Message\Infrastructure;

use App\Core\Exception\InfrastructureException;
use App\Domain\ChatModule\Message\Message;
use App\Domain\ChatModule\Message\MessageRepository;

class EloquentMessageRepository implements MessageRepository
{
    /**
     * @throws InfrastructureException
     */
    public function save(Message $message): Message
    {
        try {
            $messageModel = $message->toEloquentModel();
            $messageModel->save();
        } catch (\Throwable $exception) {
            throw InfrastructureException::fromUnexpectedThrowable($exception);
        }

        return Message::fromEloquentModel($messageModel);
    }
}
