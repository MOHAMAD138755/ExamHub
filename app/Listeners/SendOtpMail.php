<?php

namespace App\Listeners;

use App\Events\OtpGenerated;
use App\Mail\LoginOtpCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOtpMail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OtpGenerated $event): void
    {
        Mail::to($event->user->email)->queue(new LoginOtpCode($event->otp));
    }
}
