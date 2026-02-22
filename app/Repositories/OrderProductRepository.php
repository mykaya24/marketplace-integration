<?php

namespace App\Repositories;

use App\Models\OrderProduct;

class OrderProductRepository{
    public function insertBatch(array $product): void
    {
        OrderProduct::insertOrIgnore($product);
    }
    public function create(array $product): void
    {
        OrderProduct::create($product);
    }

    public function upsert($products){
         OrderProduct::upsert(
                $products,
                ['order_id', 'sku'],
                ['name', 'quantity']
            );
    }
}