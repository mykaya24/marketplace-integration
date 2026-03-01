<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Jobs\SendOrderJob;
use App\Models\OrderIntegration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateOrderIntegrations
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
    public function handle(OrderCreated $event): void
    {
        foreach (['erp', 'accounting'] as $system) {

            $integration = OrderIntegration::create([
                'order_id' => $event->order->id,
                'system_name' => $system,
                'status' => 'pending',
            ]);

            SendOrderJob::dispatch($integration)->afterCommit();
        }
    }
}
