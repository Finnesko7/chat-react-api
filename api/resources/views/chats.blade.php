<?php
use App\Domain\ChatModule\EntryPoint\RoomList\RoomInfo;
/** @var RoomInfo $room */
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat rooms') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($chats as $room)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <button class="p-2 pl-5 pr-5 bg-blue-500 text-gray-100 text-lg rounded-lg focus:border-4 border-blue-300">
                            <a href="{{ route('room', ['roomId' => $room->getRoomId()]) }}">
                                {{ 'Room: ' . $room->getRoomName() }}
                            </a>
                        </button>
                        <p>{{ 'The last message was sent at: ' . $room->getLastMessageTime() }}</p>
                    </div>
                @endforeach
                <div class="p-6 bg-white border-b border-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="room-name">
                        {{ __('Room name') }}
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="room-name" type="text" placeholder="{{ __('Enter room name') }}">
                    <span id="room-name-error" class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1"></span>
                    <button id="create-room-btn" class="p-2 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-lg focus:border-4 border-green-300 mt-2">
                        {{ __('Create room') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/chat-list.js') }}" defer></script>
</x-app-layout>
