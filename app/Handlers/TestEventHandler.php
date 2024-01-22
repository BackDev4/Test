<?php

namespace App\Handlers;
use App\Events\TestEvent;

use Illuminate\Support\Facades\Log;

class TestEventHandler
{
    public function handle(TestEvent $event)
    {
        Log::info("Handling TestEvent: {$event->message}");
    }
}
