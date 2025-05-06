<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::apiResource('orders',\App\Http\Controllers\OrderController::class)->only('index','store','update');
Route::get('order-analytics',[\App\Http\Controllers\OrderController::class,'analytics']);
