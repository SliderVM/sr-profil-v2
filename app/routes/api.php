<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BhtController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\ThicknesseController;
use App\Http\Controllers\Api\CounterpartiesController;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Controllers\Api\WarehouseTypeController;
use App\Http\Controllers\Api\aprController;


Route::resource('buhtas', BhtController::class);
Route::resource('types', TypeController::class);
Route::resource('thicknesse', ThicknesseController::class);
Route::resource('counterparties', CounterpartiesController::class);
Route::resource('warehouse', WarehouseController::class);
Route::resource('warehousetype', warehouseTypeController::class);
Route::resource('apr', aprController::class);


// Route::get('view/11', warehouseController::class, 'view');

