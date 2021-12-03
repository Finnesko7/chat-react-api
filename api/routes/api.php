<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Chat\MessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/message/send', [MessageController::class, 'send']);
});

Route::get('/chats/room/{roomId}', [ChatController::class, 'room'])->name('room');
Route::post('/chat/room/create', [ChatController::class, 'create']);
Route::get('/chats', [ChatController::class, 'list'])->name('chats');



