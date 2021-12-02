<?php

declare(strict_types = 1);

namespace App\Providers;

use App\Domain\ChatModule\EntryPoint\CreateRoom\CreateRoomAction;
use App\Domain\ChatModule\EntryPoint\RegisterChatUser\RegisterChatUserAction;
use App\Domain\ChatModule\EntryPoint\SendMessage\SendMessageAction;
use App\Domain\ChatModule\Message\Infrastructure\EloquentMessageRepository;
use App\Domain\ChatModule\Message\MessageRepository;
use App\Domain\ChatModule\Room\Infrastructure\EloquentRoomRepository;
use App\Domain\ChatModule\Room\RoomRepository;
use App\Domain\ChatModule\User\ChatUserRepository;
use App\Domain\ChatModule\User\Infrastructure\EloquentChatUserRepository;
use Illuminate\Support\ServiceProvider;

class ChatServiceProvider extends ServiceProvider
{
    public function register() : void
    {
        $this->app->bind(ChatUserRepository::class, function() {
            return new EloquentChatUserRepository();
        });
        $this->app->bind(RoomRepository::class, function() {
            return new EloquentRoomRepository();
        });
        $this->app->bind(MessageRepository::class, function() {
            return new EloquentMessageRepository();
        });
        $this->app->bind(RegisterChatUserAction::class, function($app) {
            $chatUserRepository = $app->make(ChatUserRepository::class);
            return new RegisterChatUserAction($chatUserRepository);
        });
        $this->app->bind(CreateRoomAction::class, function($app) {
            $roomRepository = $app->make(RoomRepository::class);
            return new CreateRoomAction($roomRepository);
        });
        $this->app->bind(SendMessageAction::class, function($app) {
            $chatUserRepository = $app->make(ChatUserRepository::class);
            $messageRepository = $app->make(MessageRepository::class);
            $roomRepository = $app->make(RoomRepository::class);
            return new SendMessageAction($chatUserRepository, $messageRepository, $roomRepository);
        });
    }
}
