<?php

use Illuminate\Support\Facades\Broadcast;

// channel authorization rules

/* Broadcast::channel('chat.{userId}', function () {
    return true;
}); */

Broadcast::channel('chat.{receiverUserId}.{senderUserId}', function ($user, $receiverUserId, $senderUserId) {
    return (int) $user->id === (int) $receiverUserId || (int) $user->id === (int) $senderUserId;
});

// $user is automatically provided by laravel, is the auth user, and $userId is the id that I send from the frontend, after initialize echo
Broadcast::channel('notification.{userId}', function ($user, $userId) { 
    // the request for broadcasting to subscribe this channel must be from an existing and logged user
    return (int) $user->id === (int) $userId;
});
