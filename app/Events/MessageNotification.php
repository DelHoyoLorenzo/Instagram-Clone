<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatId;
    public $userId;
    public $unseenChats = [];

    public function __construct($userId)
    {
        $this->userId = $userId;
        $chats = [];

        // trae todos los mensajes los cuales yo no soy el sender y ademas que no haya visto la otra persona
        // recorremos el arreglo de mensajes NO vistos por la/s otra/s personas
        // almacenamos en un arreglo cada vez que veo un chat_id distinto

        $unreadMessages = Message::where('receiver_user_id', $this->userId)
            ->where('seen', false)
            ->get();

        foreach ($unreadMessages as $message) {
            if (!in_array($message->chat_id, $this->unseenChats)) {
                $this->unseenChats[] = $message->chat_id;
            }
        }

        // no tengo que pensar en si vuelven a entrar a traves de otro flujo a este evento, entre por donde entre devuelvo lo mismo, las notificaciones completas

        /* if($last_receiver_message && !$last_receiver_message->seen){
            $aux = ['chatId'=>$this->chatId, 'senderUserId'=>$last_receiver_message->sender_user_id];
            array_push($chats, $aux);
        }else{
            array_filter($chats, function($chat){ return $chat->chatId !== $this->chatId; });
        }

        $this->unseenChats = $chats; */
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return [
            new Channel('notification'),
        ];
    }

    public function broadcastWith()
    {
        return [
            'unseenChats' => $this->unseenChats,
        ];
    }
}
