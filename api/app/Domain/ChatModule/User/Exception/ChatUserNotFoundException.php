<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\User\Exception;

use App\Core\Exception\BusinessLogicException;
use App\Core\Exception\ErrorCode;
use App\Domain\ChatModule\User\ValueObject\UserId;

class ChatUserNotFoundException extends BusinessLogicException
{
    public static function withUserId(UserId $userId): static
    {
        return new static(
            sprintf('Not found chat user for related user with id "%s".', $userId->get()),
            ErrorCode::CHAT_USER_NOT_FOUND,
        );
    }
}
