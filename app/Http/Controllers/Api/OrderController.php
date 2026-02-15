<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService, private OrderResource $orderResource)
    {}
    public function store(){
        $orders =  $this->orderService->getOrders();
        //dd($orders);
        return $this->orderResource->getResponse($orders);
    }
}
