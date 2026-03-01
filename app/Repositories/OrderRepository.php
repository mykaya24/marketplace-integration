<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderProduct;

class OrderRepository{
    
    public function insertBatch(array $orders): void
    {
        Order::insertOrIgnore($orders);
    }
    public function create(array $orders): void
    {
        Order::create($orders);
    }

    public function updateOrCreate($order){
        $orderModel = Order::updateOrCreate(
                ['order_id' => $order['order_id']],
                $order
            );
        return $orderModel;
    }

    public function getById($id){
        return Order::with("orderProducts")->find($id);
    }

    
}