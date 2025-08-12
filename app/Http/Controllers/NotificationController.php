<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{


    public function markRead($id)
    {
        $notification = DatabaseNotification::where('id', $id)
            ->where('notifiable_id', Auth::id())
            ->first();

        if (!$notification) {
            return back()->with('error', 'Notification not found.');
        }

        $notification->markAsRead();

        return back()->with('success', 'Notification marked as read.');
    }
}