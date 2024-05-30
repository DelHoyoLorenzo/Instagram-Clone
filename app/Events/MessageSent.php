<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        /* [
            "content" => "asd"
            "sender_user_id" => 1
            "receiver_user_id" => 2
            "chat_id" => 1
            "updated_at" => "2024-05-30 18:16:42"
            "created_at" => "2024-05-30 18:16:42"
            "id" => 41
          ] */
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return [
            new PrivateChannel('chat.' . $this->message->receiver_user_id . '.' . $this->message->sender_user_id),
            new PrivateChannel('chat.' . $this->message->sender_user_id . '.' . $this->message->receiver_user_id),
        ];
    }

    public function broadcastWith()
    {
        return [
            'eventMessage' => $this->message,
        ];
    }
}