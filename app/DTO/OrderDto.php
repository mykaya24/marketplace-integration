<?php

namespace App\DTO;

class OrderDTO
{
    public function __construct(
        public readonly string $orderId,
        public readonly string $date,
        public readonly string $category,
        public readonly OrderShippingDTO $shipping,
        public readonly OrderBillingDTO $billing,
        public readonly string $sendType,
        public readonly string $description,
        public readonly string $barkod,
        public readonly string $invoiceNumber,
        public readonly string $orderNumber,
        public readonly string $commissionAmount,
        public readonly string $commissionRate,
        public readonly array $rows
    ) {}

    public static function fromArray($data): self
    {
        return new self(
            $data["orderId"],
            $data["orderDate"],
            "Hepsiburada_Final Price",
             OrderShippingDTO::fromArray($data),
             OrderBillingDTO::fromArray($data),
             "YENI",
             "",
             "",
             "",
             $data["orderNumber"],
             $data["commission"]["amount"],
             $data["commissionRate"],
            [new OrderRowDTO($data["sku"],$data["quantity"],$data["name"])]
        );

    }
}