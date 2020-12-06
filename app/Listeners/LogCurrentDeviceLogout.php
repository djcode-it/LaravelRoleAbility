<?php

namespace App\Listeners;

use Illuminate\Auth\Events\CurrentDeviceLogout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogCurrentDeviceLogout
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
     * @param  CurrentDeviceLogout  $event
     * @return void
     */
    public function handle(CurrentDeviceLogout $event)
    {
        //
    }
}
