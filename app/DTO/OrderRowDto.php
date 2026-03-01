<?php

namespace App\DTO;

class OrderRowDTO
{
    public function __construct(
        public readonly string $sku,
        public readonly string $quantity,
        public readonly string $name,
        public readonly ?string $price,
        public readonly ?string $vatRate
    ) {}

    public function toArray(): array
    {
        return [
                'sku'=> $this->sku,
                'quantity'=> $this->quantity,
                'name'=>$this->name,
                'price'=>$this->price,
                'vat_rate'=>$this->vatRate
        ];
    }
}