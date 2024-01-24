<?php

namespace App\Http\Services;

use App\Http\Repositories\EventNotifyChannelRepository;
use App\Http\Repositories\EventRepository;
use App\Http\Requests\PostEventRequest;

class EventService
{
    /**
     * @var EventRepository
     */
    private $eventRepository;

    /**
     * @var EventNotifyChannelRepository
     */
    private $eventNotifyChannelRepository;

    /**
     * @param  EventRepository  $eventRepository
     * @param  EventNotifyChannelRepository  $eventNotifyChannelRepository
     */
    public function __construct(
        EventRepository $eventRepository,
        EventNotifyChannelRepository $eventNotifyChannelRepository
    ) {
        $this->eventRepository = $eventRepository;
        $this->eventNotifyChannelRepository = $eventNotifyChannelRepository;
    }

    public function getEvents()
    {
        return $this->eventRepository->getEvents();
    }

    public function updateEvent(int $eventId, PostEventRequest $request)
    {
        $event = $this->eventRepository->updateEvent(
            $eventId,
            $request->only(['name', 'trigger_time'])
        );

        $user = auth()->user();
        if ($event->id !== $user->id) {
            throw new \Exception();
        }

        $this->eventNotifyChannelRepository->deleteByEventId($eventId);

        $this->eventNotifyChannelRepository->createByEventId(
            $event->id,
            $request->notify_channel_ids,
            json_encode($request->messages)
        );
    }
}
