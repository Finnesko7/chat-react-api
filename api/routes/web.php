<?php

use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Chat\MessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/api', function () {
    return view('welcome');
});

Route::prefix('/api')->group(function () {
    Route::get('/chats', [ChatController::class, 'list'])->name('chats');
    Route::get('/chats/room/{roomId}', [ChatController::class, 'room'])->name('room');
    Route::post('/chat/room/create', [ChatController::class, 'create']);
    Route::post('/message/send', [MessageController::class, 'send']);
});

require __DIR__ . '/auth.php';
