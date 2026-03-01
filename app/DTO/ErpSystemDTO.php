<?php

namespace App\DTO;

use App\Models\OrderProduct;

class ErpSystemDTO
{
    public function __construct(
        public readonly string $date,
        public readonly string $category,
        public readonly ?string $customer,
        public readonly string $adress,
        public readonly string $phone,
        public readonly string $city,
        public readonly string $town,
        public readonly string $orderNumber,
        public readonly string $sendType,
        public readonly string $description,
        public readonly string $commissionAmount,
        public readonly string $commissionRate,
        public readonly array $products
    ) {}

    public static function fromOrder($order): self
    {
        return new self(
            $order->date,    
            $order->category,
            $order->shipping_customer,
            $order->shipping_adress,
            $order->shipping_phone,
            $order->shipping_city,
            $order->shipping_town,
            $order->order_number,
            $order->send_type,
            $order->description,
            $order->commission_amount,
            $order->commission_rate,
            self::findRowProduct($order->orderProducts)

        );

    }

    public function toArray(): array
    {
        $rows = array();
        foreach($this->products as $r)
            $rows[] = $r->toArray();
        return [
                'date'=> $this->date,
                'category'=> $this->category,
                'customer'=>$this->customer,
                'adress'=> $this->adress,
                'phone'=> $this->phone,
                'city'=> $this->city,
                'town'=> $this->town,
                'order_number'=> $this->orderNumber,
                'send_type'=> $this->sendType,
                'description'=> $this->description,
                'commission_amount'=> $this->commissionAmount,
                'commission_rate'=> $this->commissionRate,
                'products'=>$rows
                
        ];
    }
    private static function findRowProduct($data): array
    {
        //dd($data);
        $return = [];
        foreach($data as $d){
            $return[]  = new OrderRowDTO($d->sku,$d->quantity,$d->name,$d->price,$d->vat_rate);
        }
        return $return;
    }
    
}