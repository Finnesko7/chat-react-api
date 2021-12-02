<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatTables extends Migration
{
    public function up(): void
    {
        Schema::create('chat_users', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nickname', 24)->nullable(false)->unique();
            $table->foreign('user_id', 'chat_user')
                ->references('id')
                ->on('users');
        });
        Schema::create('chat_rooms', static function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->nullable(false)->unique();
        });
        Schema::create('chat_messages', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('chat_user_id');
            $table->string('text', 240)->nullable(false);
            $table->dateTime('sent_time')->nullable(false);
            $table->foreign('room_id', 'room_message')
                ->references('id')
                ->on('chat_rooms');
            $table->foreign('chat_user_id', 'message_user')
                ->references('id')
                ->on('chat_users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('chat_rooms');
        Schema::dropIfExists('chat_users');
    }
}
