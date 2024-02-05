<?php

namespace App\Jobs;

use App\Mail\EventMail;
use App\Models\EventNotifyChannel;
use App\Models\User;
use Ev;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;

class EmailNotify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var EventNotifyChannel
     */
    private $eventNotifyChannel;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     */
    public function __construct(EventNotifyChannel $eventNotifyChannel, User $user)
    {
        $this->eventNotifyChannel = $eventNotifyChannel;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $messages = json_decode($this->eventNotifyChannel->message_json, true);
        $msg = $messages[$this->user->language->code];

        $eventMail = app(EventMail::class, ['user' => $this->user, 'msg'=> $msg]);
        // $eventMail = new EventMail($this->user, $msg);
        Mail::to($this->user->email)->send($eventMail);
    }
}
