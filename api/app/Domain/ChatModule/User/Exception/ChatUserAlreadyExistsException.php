<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\User\Exception;

use App\Core\Exception\BusinessLogicException;
use App\Core\Exception\ErrorCode;
use App\Domain\ChatModule\User\ValueObject\Nickname;

class ChatUserAlreadyExistsException extends BusinessLogicException
{
    public static function withSameNickname(Nickname $nickname): static
    {
        return new static(
            sprintf('Chat user with nickname "%s" already registered.', $nickname->get()),
            ErrorCode::CHAT_USER_ALREADY_EXIST,
        );
    }
}
