<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Resources\OrderResource;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use App\Services\HepsiburadaApiService;
use App\Services\OrderService;
use App\Services\SendExternalApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('get/orders', function () {
        $orderController = new OrderController(new OrderService(new OrderRepository,new OrderProductRepository,new HepsiburadaApiService,new SendExternalApiService(new OrderRepository)), new OrderResource);
        return $orderController->store();
    });
});
