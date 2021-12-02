<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\User;

use App\Domain\ChatModule\User\Infrastructure\ChatUserModel;
use App\Domain\ChatModule\User\ValueObject\ChatUserId;
use App\Domain\ChatModule\User\ValueObject\Nickname;
use App\Domain\ChatModule\User\ValueObject\UserId;

class ChatUser
{
    private ?ChatUserId $id = null;
    private UserId $userId;
    private Nickname $nickname;

    public function __construct(UserId $userId, Nickname $nickname)
    {
        $this->userId = $userId;
        $this->nickname = $nickname;
    }

    public static function fromEloquentModel(ChatUserModel $chatUserModel): static
    {
        $chatUser = new static(
            UserId::make((int) $chatUserModel->{ChatUserModel::USER_ID_FIELD}),
            Nickname::make($chatUserModel->{ChatUserModel::NICKNAME_FIELD}),
        );
        $chatUser->id = ChatUserId::make((int) $chatUserModel->{ChatUserModel::ID_FIELD});

        return $chatUser;
    }

    public function toEloquentModel(): ChatUserModel
    {
        $chatUserModel = new ChatUserModel();
        $chatUserModel->{ChatUserModel::USER_ID_FIELD} = $this->userId->get();
        $chatUserModel->{ChatUserModel::NICKNAME_FIELD} = $this->nickname->get();
        if (!is_null($this->id)) {
            $chatUserModel->{ChatUserModel::ID_FIELD} = $this->id->get();
        }

        return $chatUserModel;
    }

    public function getId() : ?ChatUserId
    {
        return $this->id;
    }

    public function getUserId() : UserId
    {
        return $this->userId;
    }

    public function getNickname() : Nickname
    {
        return $this->nickname;
    }
}
