<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Resources\OrderResource;
use App\Services\HepsiburadaApiService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('get/orders', function () {
        $orderController = new OrderController(new OrderService(new HepsiburadaApiService), new OrderResource);
        return $orderController->store();
    });
});
