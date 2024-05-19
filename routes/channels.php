<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat', function () {
    return true;
});

Broadcast::channel('notification', function () {
    return true;
});
