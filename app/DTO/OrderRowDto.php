<?php

namespace App\DTO;

class OrderRowDTO
{
    public function __construct(
        public readonly string $sku,
        public readonly string $quantity,
        public readonly string $name
    ) {}
}