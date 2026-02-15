<?php

namespace App\DTO;

class OrderBillingDTO
{
    public function __construct(
        public readonly string $customer,
        public readonly string $tcNo,
        public readonly ?string $taxNumber,
        public readonly ?string $taxOffice,
        public readonly string $adress,
        public readonly string $phone,
        public readonly string $city,
        public readonly string $town
    ) {}

    public static function fromArray($data): self
    {
        return new self(
            $data["invoice"]["address"]["name"],    
            $data["invoice"]["turkishIdentityNumber"],
            $data["invoice"]["taxNumber"],
            $data["invoice"]["taxOffice"],
            $data["invoice"]["address"]["address"],
            $data["invoice"]["address"]["phoneNumber"],
            $data["invoice"]["address"]["city"],
            $data["invoice"]["address"]["town"]
        );

    }
}