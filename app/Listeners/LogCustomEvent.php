<?php

namespace App\Listeners;

use App\Events\CustomEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogCustomEvent
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
     * @param CustomEvent $event
     * @return void
     */
    public function handle(CustomEvent $event)
    {
        \Log::alert("log from custom event");
        \Log::alert($event->user);
    }
}
