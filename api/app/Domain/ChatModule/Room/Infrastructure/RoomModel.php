<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\Room\Infrastructure;

use Illuminate\Database\Eloquent\Model;

class RoomModel extends Model
{
    public const ID_FIELD = 'id';
    public const NAME_FIELD = 'name';

    protected $fillable = [
        self::NAME_FIELD,
    ];

    protected $table = 'chat_rooms';

    public $timestamps = false;
}
