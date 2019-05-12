<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    
    public function show ($id) {
        $notification = Auth::user()->unreadNotifications()->find($id);
        if($notification) {
            $notification->markAsRead();
        }
        return redirect()->back();
    }
}
