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
    public $receiver_id;
    public $unseenChats = [];

    public function __construct($receiver_user_id)
    {
        //dd($receiver_user_id); //1 si mando un mensaje desde el usuario de luna
        $this->receiver_id = $receiver_user_id;

        // trae todos los mensajes los cuales yo no soy el sender y ademas que no haya visto la otra persona
        // recorremos el arreglo de mensajes NO vistos por la/s otra/s personas
        // almacenamos en un arreglo cada vez que veo un chat_id distinto
        $unreadMessages = Message::where('receiver_user_id', $this->receiver_id)
            ->where('seen', false)
            ->get();

        // looking for chat ids from unread messages
        foreach ($unreadMessages as $message) {
            if (!in_array($message->chat_id, $this->unseenChats)) {
                $this->unseenChats[] = $message->chat_id;
            }
        }

        /* else if($this->clear_chat === true){
            $this->unseenChats = array_filter($this->unseenChats, function($chat_id) use ($message){
                return $chat_id !== $message->chat_id;
            });

            $this->unseenChats = array_values($this->unseenChats);
        } */

        // no tengo que pensar en si vuelven a entrar a traves de otro flujo a este evento, entre por donde entre devuelvo lo mismo, las notificaciones completas
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notification.'.$this->receiver_id);
    }

    public function broadcastWith()
    {
        return [
            'unseenChats' => $this->unseenChats,
        ];
    }
}
