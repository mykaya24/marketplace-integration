<?php

namespace App\Services;

use App\DTO\OrderDTO;
use App\Events\OrderCreated;
use App\Events\OrdersFetched;
use App\Models\OrderIntegration;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPSTORM_META\type;

class OrderService
{
    public function __construct(
                            private OrderRepository $orderRepository, 
                            private OrderProductRepository $orderProductRepository, 
                            private HepsiburadaApiService $hepsiburadaService,
                            private SendExternalApiService $sendExternalApiService) {}

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
            //dd($orders);
            foreach ($orders as $ord) {
                $orderList[] = OrderDTO::fromArrayPackaged($ord);
            }
            $i++;
        } while (count($orders)==10);
        event(new OrdersFetched(
            array_map(fn($dto) => $dto->toArray(), $orderList)
        ));
    }

    public function addOrdersDb($orders){
        
        foreach($orders as $order){    
            DB::transaction(function () use ($order) {
                $orderRows = $order['rows'];
                unset($order["rows"]);
                $orderDb = $this->orderRepository->updateOrCreate($order);
                $products = collect($orderRows)
                    ->map(function ($item) use ($orderDb) {
                        $item['order_id'] = $orderDb->id;
                        return $item;
                    })->toArray();
                
                $this->orderProductRepository->upsert($products); 
                event(new OrderCreated($orderDb));   
            });
        }
        
    }

    public function sendOrderExternalApi(OrderIntegration $orderIntegration){
        $api = $this->sendExternalApiService->sendOrder($orderIntegration);
        // burda api den dönen response orderIntegration içerisine kaydedilecek
    }
}
