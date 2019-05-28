<?php

namespace Rumi\Http\Controllers\Roomer;

use Illuminate\Http\Request;
use Rumi\RoomNotification;
use Auth;
use Rumi\Http\Controllers\Controller;

class RoomerNotificationController extends Controller
{
    public function getAllRoomNotifications(){
        $roomerId = Auth::guard('roomer')->user()->id;
        $allNotifications = RoomNotification::all()->where('roomer_id', $roomerId);
        

        return response()->json([
            'status' => 'success',
            'response' => $allNotifications,
        ]);
    }

    public function showNotification($notificationId){
        $roomerId = Auth::guard('roomer')->user()->id;
        $notification = RoomNotification::where('roomer_id', $roomerId)->find($notificationId);
        $notification->status = 'read';
        $notification->save();

        return response()->json([
            'status' => 'success',
            'response' => $notification,
        ]);
    }

    public function noOfUnreadNotifications(){
        $roomerId = Auth::guard('roomer')->user()->id;
        $unreadNotifications = RoomNotification::where('roomer_id', $roomerId)->where('status', 'unread')->get();

        $no = count($unreadNotifications);

        return response()->json([
            'status' => 'success',
            'response' => $no,
        ]);
    }
}
