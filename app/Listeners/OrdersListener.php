<?php

namespace App\Listeners;

use App\Events\OrdersFetched;
use App\Jobs\OrdersAddDataJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrdersListener implements ShouldQueue
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
    public function handle(OrdersFetched $event): void
    {
        OrdersAddDataJob::dispatch($event->orders);
    }
}
