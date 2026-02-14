<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Resources\OrderResource;
use App\Services\HepsiburadaApiService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/get/orders', function (Request $request) {
    $orders = new OrderController(new OrderService(new HepsiburadaApiService));
    $resource = new OrderResource();
    return $resource->getResponse($orders->store());
});

