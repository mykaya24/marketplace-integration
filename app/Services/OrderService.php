<?php

namespace App\Services;

use App\DTO\OrderDTO;

use function PHPSTORM_META\type;

class OrderService
{
    public function __construct(private HepsiburadaApiService $hepsiburadaService) {}

    public function getOrders()
    {
        $i = 0;
        $orderList = array();
        do {
            $orders = $this->hepsiburadaService->getNotPackagedOrders($i * 10);
            foreach ($orders["items"] as $ord) {
                $orderList[] = OrderDTO::fromArray($ord);
            }
            $i++;
        } while ($orders["pageCount"] > $i);

        $i = 0;
        do {
            $orders = $this->hepsiburadaService->getPackagedOrders($i * 10);
            foreach ($orders["items"] as $ord) {
                $orderList[] = OrderDTO::fromArray($ord);
            }
            $i++;
        } while ($orders["pageCount"] > $i);
        return $orderList;
    }
}
