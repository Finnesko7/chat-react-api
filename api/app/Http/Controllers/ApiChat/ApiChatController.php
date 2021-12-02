<?php

declare(strict_types = 1);

namespace App\Http\Controllers\ApiChat;

use App\Http\Controllers\Controller;

class ApiChatController extends Controller
{
    public function info()
    {
        dd('Good!');

        return response()->json([
            'status' => 'success'
        ]);
    }
}
