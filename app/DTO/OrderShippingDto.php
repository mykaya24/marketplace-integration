<?php

namespace App\DTO;

class OrderShippingDTO
{
    public function __construct(
        public readonly string $customer,
        public readonly string $adress,
        public readonly string $phone,
        public readonly string $city,
        public readonly string $town
    ) {}

    public static function fromArray($data): self
    {
        return new self(
            $data["shippingAddress"]["name"],
            $data["shippingAddress"]["address"],
            $data["shippingAddress"]["phoneNumber"],
            $data["shippingAddress"]["city"],
            $data["shippingAddress"]["town"]
        );

    }
}