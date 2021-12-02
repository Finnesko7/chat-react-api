<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\User\Infrastructure;

use Illuminate\Database\Eloquent\Model;

class ChatUserModel extends Model
{
    public const ID_FIELD = 'id';
    public const USER_ID_FIELD = 'user_id';
    public const NICKNAME_FIELD = 'nickname';

    protected $fillable = [
        self::USER_ID_FIELD,
        self::NICKNAME_FIELD,
    ];

    protected $table = 'chat_users';

    public $timestamps = false;
}
