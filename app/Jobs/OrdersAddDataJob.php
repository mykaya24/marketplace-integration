<?php

namespace App\Jobs;

use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class OrdersAddDataJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public array $orders)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(OrderService $orderService): void
    {
         $orderService->addOrdersDb($this->orders);
    }
}
