<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationSeenController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notification marked as read.');
    }
}
