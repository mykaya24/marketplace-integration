<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HepsiburadaApiService{
    public function getNotPackagedOrders($offset){
         
    //hb dto oluştur datayı öyle al

        $response = Http::withHeaders([
            'User-Agent'=>config('services.hepsiburada.agent'),
            'merchantId'=>config('services.hepsiburada.merchaint_id'),
            'Authorization' => 'Basic ' . base64_encode(
                config('services.hepsiburada.merchant_id') . ':' .
                config('services.hepsiburada.service_key')
            )
        ])->get(config('services.hepsiburada.base_url') . '/orders/merchantid/'.config('services.hepsiburada.merchant_id').'?offset='.$offset.'&limit=10');

        if ($response->failed()) {
            throw new \Exception('Hepsiburada API error');
        }
        return $response->json();
    }
}