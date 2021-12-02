<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\User;

use App\Core\Exception\InfrastructureException;
use App\Domain\ChatModule\User\Exception\ChatUserAlreadyExistsException;
use App\Domain\ChatModule\User\ValueObject\UserId;

interface ChatUserRepository
{
    /**
     * @throws InfrastructureException
     */
    public function findByUserId(UserId $userId): ?ChatUser;

    /**
     * @throws InfrastructureException
     * @throws ChatUserAlreadyExistsException
     */
    public function save(ChatUser $chatUser): ChatUser;
}
