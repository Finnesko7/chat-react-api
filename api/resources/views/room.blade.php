<?php
use App\Domain\ChatModule\EntryPoint\RoomMessagesList\MessageInfo;
/** @var MessageInfo $message */
?>
<x-app-layout>
    <x-slot name="header">
        <h2 id="room-id" data-id="{{ $roomId }}" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Room ' . $roomId }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="chat-messages" class="bg-white shadow-sm sm:rounded-lg overflow-scroll" style="height:50vh">
                @foreach ($messages as $message)
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>{{ 'Author: ' . $message->getAuthorName() }}</p>
                    <p>{{ $message->getText() }}</p>
                    <p>{{ 'Sent at: ' . $message->getSendTime() }}</p>
                </div>
                @endforeach
            </div>
            <div id="send-msg-div" class="p-6 bg-white border-b border-gray-200">
                <input id="chat-message" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="{{ __('Enter message') }}">
                <button id="send-msg-btn" class="p-2 pl-5 pr-5 bg-green-500 text-gray-100 text-lg rounded-lg focus:border-4 border-green-300 mt-2">
                    {{ __('Send') }}
                </button>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/chat.js') }}" defer></script>
</x-app-layout>
