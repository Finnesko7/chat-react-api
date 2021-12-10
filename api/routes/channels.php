<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('notification.{roomId}', function ($user) {
    /** @var $user User */
    if ($user) {
        return [
            'id' => $user->id,
            'name' => $user->name
        ];
    }

    return false;
});
