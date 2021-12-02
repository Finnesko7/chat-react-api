<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Message\Infrastructure;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    public const ID_FIELD = 'id';
    public const CHAT_ROOM_ID_FIELD = 'room_id';
    public const CHAT_USER_ID_FIELD = 'chat_user_id';
    public const TEXT_FIELD = 'text';
    public const SEND_TIME = 'sent_time';

    protected $fillable = [
        self::CHAT_ROOM_ID_FIELD,
        self::CHAT_USER_ID_FIELD,
        self::TEXT_FIELD,
    ];

    protected $table = 'chat_messages';

    public $timestamps = false;
}
