<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\EntryPoint\RoomMessagesList;

use App\Domain\ChatModule\Room\ValueObject\RoomId;
use Illuminate\Support\Facades\DB;

class RoomMessagesListQuery
{
    private const MASSAGE_NUMBER_IN_ROOM_VIEW = 50;

    public function run(RoomId $roomId): MessageInfoCollection
    {
        $messagesData = DB::table('chat_messages')
            ->leftJoin('chat_users', 'chat_messages.chat_user_id', '=', 'chat_users.id')
            ->select('chat_messages.text', 'chat_messages.sent_time', 'chat_users.nickname')
            ->where('chat_messages.room_id', '=', $roomId->get())
            ->orderBy('chat_messages.sent_time')
            ->limit(self::MASSAGE_NUMBER_IN_ROOM_VIEW)
            ->get();
        $messagesInfo = new MessageInfoCollection();
        foreach ($messagesData as $messageData) {
            $messageInfo = new MessageInfo(
                $messageData->nickname,
                $messageData->text,
                $messageData->sent_time,
            );
            $messagesInfo->add($messageInfo);
        }

        return $messagesInfo;
    }
}
