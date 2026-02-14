<?php

    namespace App\Services;

    class OrderService{
        public function __construct(private HepsiburadaApiService $hepsiburadaService)
        {}

        public function getOrders(){  
            return $this->hepsiburadaService->getOrders();
        }
    }