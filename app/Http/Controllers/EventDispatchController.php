<?php

namespace App\Http\Controllers;

use App\Jobs\LineNotify;
use App\Models\EventNotifyChannel;
use App\Models\User;

class EventDispatchController
{
    public function lineNotify()
    {
        $eventNotifyChannel = EventNotifyChannel::find(13);
        $user = auth()->user();

        LineNotify::dispatchSync($eventNotifyChannel, $user);

        return response()->json(['message' => 'Line Notify sent']);
    }
}
