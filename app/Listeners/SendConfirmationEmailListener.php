<?php

namespace App\Listeners;

use App\Events\SendConfirmationEmailEvent;
use App\Mail\ConfirmationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendConfirmationEmailListener
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
     * @param \App\Events\SendConfirmationEmailEvent $event
     * @return void
     */
    public function handle(SendConfirmationEmailEvent $event)
    {
        Mail::to($event->email)->send(new ConfirmationEmail($event->link));
    }
}
