<?php declare(strict_types=1);

namespace App\Domain\ChatModule\Message\Event;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageWasSend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $roomId;
    public string $author;
    public string $text;
    public string $sendTime;
    public int $authorId;

    public function __construct(
        int    $roomId,
        string $author,
        string $message,
        string $sendTime,
        int $authorId
    )
    {
        $this->roomId = $roomId;
        $this->author = $author;
        $this->sendTime = $sendTime;
        $this->text = $message;
        $this->authorId = $authorId;
        $this->dontBroadcastToCurrentUser();
    }

    public function broadcastOn(): Channel
    {
        return new Channel('notification.' . $this->roomId);
    }

    public function broadcastAs(): string
    {
        return 'message.send';
    }
}
