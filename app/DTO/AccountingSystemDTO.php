<?php

namespace App\DTO;

use App\Models\OrderProduct;

class AccountingSystemDTO
{
    public function __construct(
        public readonly string $date,
        public readonly ?string $customer,
        public readonly ?string $tcNo,
        public readonly ?string $taxNumber,
        public readonly ?string $taxOffice,
        public readonly string $adress,
        public readonly string $phone,
        public readonly string $city,
        public readonly string $town,
        public readonly string $orderNumber,
        public readonly string $description,
        public readonly string $packageNumber,
        public readonly string $shippingModel,
        public readonly array $products
    ) {}

    public static function fromOrder($order): self
    {
        return new self(
            $order->date,    
            $order->billing_customer,
            $order->billing_tc_no,
            $order->billing_tax_number,
            $order->billing_tax_office,
            $order->billing_adress,
            $order->billing_phone,
            $order->billing_city,
            $order->billing_town,
            $order->order_number,
            $order->description,
            $order->package_number,
            $order->shipping_model,
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
                'customer'=>$this->customer,
                'tc_no'=>$this->tcNo,
                'tax_number'=>$this->taxNumber,
                'tax_office'=>$this->taxOffice,
                'adress'=> $this->adress,
                'phone'=> $this->phone,
                'city'=> $this->city,
                'town'=> $this->town,
                'order_number'=> $this->orderNumber,
                'description'=> $this->description,
                'package_number'=> $this->packageNumber,
                'shipping_model'=> $this->shippingModel,
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