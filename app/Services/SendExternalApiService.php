<?php

namespace App\Services;

use App\DTO\AccountingSystemDTO;
use App\DTO\ErpSystemDTO;
use App\Enums\IntegrationSystem;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Http;

class SendExternalApiService
{
    public function __construct(private OrderRepository $orderRepository) {}

    public function sendOrder($orderIntegration){
        $system = $orderIntegration->system_name;
        $order = $this->orderRepository->getById($orderIntegration->order_id);

        $dto = match ($system) {
            IntegrationSystem::ERP->value => ErpSystemDTO::fromOrder($order),
            IntegrationSystem::ACCOUNTING->value => AccountingSystemDTO::fromOrder($order),
            default => null
        };

        if($dto !== null)
            $response = Http::post(config('services.externalApi.'.$system), $dto->toArray());
        
        //dönen response u dbye kaydedeceğiz ve işlem bitecek
        //daha sonra job eğer başarılı olmadıysa tekrar başlatmak gerek
        /*if($response->status ===  200)
            $orderIntegration->status = "BASARILI";
        $orderIntegration->http_status = $response->status;
        $orderIntegration->response_body = $response->body;
        $orderIntegration->retry_count++;
        if($response->status >=  400)
            $orderIntegration->last_error = $response->error;
        
        $orderIntegration->save();*/
        dd($response);
    }

}
