<?php

namespace App\Http\Repositories;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EventRepository
{
    public function getEvents()
    {
        return Event::with('eventNotifyChannels')
            ->select('events.id', 'events.name', 'trigger_time')
            ->paginate(2);
    }

    public function updateEvent(int $eventId, array $data)
    {
        $event = Event::findOrFail($eventId);
        $event->fill($data)->save();

        return $event;
    }
}
