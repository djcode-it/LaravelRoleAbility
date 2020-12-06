<?php

namespace App\Listeners;

use App\Mail\UserRegistred;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogRegisteredUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        \Log::info($event->user);

        \Mail::to($event->user)->send(new UserRegistred($event->user));

        $event->user->notify(new \App\Notifications\UserRegistred($event->user));
    }
}
