<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\User\Infrastructure;

use App\Core\Exception\ErrorCode;
use App\Core\Exception\InfrastructureException;
use App\Domain\ChatModule\User\ChatUser;
use App\Domain\ChatModule\User\ChatUserRepository;
use App\Domain\ChatModule\User\Exception\ChatUserAlreadyExistsException;
use App\Domain\ChatModule\User\ValueObject\UserId;
use Illuminate\Database\QueryException;

class EloquentChatUserRepository implements ChatUserRepository
{
    /**
     * @throws InfrastructureException
     */
    public function findByUserId(UserId $userId): ?ChatUser
    {
        try {
            $userModel = ChatUserModel::where(ChatUserModel::USER_ID_FIELD, '=', $userId->get())
                ->first();
            $chatUser = !is_null($userModel) ? ChatUser::fromEloquentModel($userModel) : null;
        } catch (\Throwable $exception) {
            throw InfrastructureException::fromUnexpectedThrowable($exception);
        }

        return $chatUser;
    }

    /**
     * @throws InfrastructureException
     * @throws ChatUserAlreadyExistsException
     */
    public function save(ChatUser $chatUser): ChatUser
    {
        try {
            $userModel = $chatUser->toEloquentModel();
            $userModel->save();
        } catch (QueryException $queryException) {
            $errorCode = (int) $queryException->errorInfo[1];
            if ($errorCode === ErrorCode::ELOQUENT_DUPLICATE_ENTRY_ERROR) {
                throw ChatUserAlreadyExistsException::withSameNickname($chatUser->getNickname());
            } else {
                throw InfrastructureException::fromUnexpectedThrowable($queryException);
            }

        } catch (\Throwable $exception) {
            throw InfrastructureException::fromUnexpectedThrowable($exception);
        }

        return ChatUser::fromEloquentModel($userModel);
    }
}
