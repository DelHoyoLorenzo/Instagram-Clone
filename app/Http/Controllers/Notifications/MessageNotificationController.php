<?php

namespace App\Http\Controllers\Notifications;

use App\Events\MessageNotification as EventsMessageNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageNotificationController extends Controller
{ 
    // this is for clearing the notification
    public function index()
    {
        event(new EventsMessageNotification('seen'));
    }
}
