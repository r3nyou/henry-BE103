<?php

namespace App\Http\Controllers;

use App\Jobs\EmailNotify;
use App\Jobs\LineNotify;
use App\Models\EventNotifyChannel;
use App\Models\User;
use Illuminate\Http\Request;

class EventDispatchController
{
    public function lineNotify()
    {
        $eventNotifyChannel = EventNotifyChannel::find(13);
        $user = auth()->user();

        LineNotify::dispatchSync($eventNotifyChannel, $user);

        return response()->json(['message' => 'Line Notify sent']);
    }

    public function emailNotify(Request $request)
    {
        $eventNotifyChannel = EventNotifyChannel::find(4);
        $user = auth()->user();

        EmailNotify::dispatchSync($eventNotifyChannel, $user);

        return response()->json(['message' => 'Email Notification sent']);
    }
}
