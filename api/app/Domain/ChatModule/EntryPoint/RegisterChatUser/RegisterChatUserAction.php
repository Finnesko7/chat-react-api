<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\EntryPoint\RegisterChatUser;

use App\Core\Exception\InfrastructureException;
use App\Core\ValueObject\Exception\InvalidIdException;
use App\Domain\ChatModule\User\ChatUser;
use App\Domain\ChatModule\User\ChatUserRepository;
use App\Domain\ChatModule\User\Exception\ChatUserAlreadyExistsException;
use App\Domain\ChatModule\User\Exception\InvalidNicknameException;
use App\Domain\ChatModule\User\ValueObject\Nickname;
use App\Domain\ChatModule\User\ValueObject\UserId;

class RegisterChatUserAction
{
    private ChatUserRepository $chatUserRepository;

    public function __construct(ChatUserRepository $chatUserRepository)
    {
        $this->chatUserRepository = $chatUserRepository;
    }

    /**
     * @throws InfrastructureException
     * @throws InvalidIdException
     * @throws InvalidNicknameException
     * @throws ChatUserAlreadyExistsException
     */
    public function run(RegisterChatUserParameters $registerChatUserParameters): ChatUser
    {
        $userId = UserId::make($registerChatUserParameters->getUserId());
        $nickname = Nickname::make($registerChatUserParameters->getNickname());
        $chatUser = new ChatUser($userId, $nickname);

        return $this->chatUserRepository->save($chatUser);
    }
}
