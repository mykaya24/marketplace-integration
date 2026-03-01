<?php

namespace App\Jobs;

use App\Models\OrderIntegration;
use App\Services\OrderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendOrderJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public OrderIntegration $orderIntegration)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(OrderService $orderService): void
    {
        $orderService->sendOrderExternalApi($this->orderIntegration);
    }
}
