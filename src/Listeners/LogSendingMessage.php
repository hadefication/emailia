<?php

namespace Hadefication\Emailia\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Queue\InteractsWithQueue;

class LogSendingMessage
{
    public function handle(MessageSending $event)
    {
        //
    }
}
