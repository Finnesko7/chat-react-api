<?php

declare(strict_types = 1);

namespace App\Domain\ChatModule\EntryPoint\RoomList;

use Illuminate\Support\Facades\DB;

class RoomListQuery
{
    private const MESSAGES_NOT_SEND_YET = '-';

    /**
     * @return RoomInfoCollection
     */
    public function run(): RoomInfoCollection
    {
        $roomsData = DB::table('chat_rooms')
            ->leftJoin('chat_messages', 'chat_rooms.id', '=', 'chat_messages.room_id')
            ->select('chat_rooms.*', DB::raw('MAX(sent_time) as lastMessageSentTime'))
            ->groupBy('chat_rooms.id')
            ->get();

        $roomsInfo = new RoomInfoCollection();

        foreach ($roomsData as $roomData) {
            $roomInfo = new RoomInfo(
                $roomData->id,
                $roomData->name,
                $roomData->lastMessageSentTime ?? self::MESSAGES_NOT_SEND_YET,
            );
            $roomsInfo->add($roomInfo);
        }

        return $roomsInfo;
    }
}
