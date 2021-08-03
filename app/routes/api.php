<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BhtController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\ThicknesseController;
use App\Http\Controllers\Api\CounterpartiesController;
use App\Http\Controllers\Api\WarehouseController;
use App\Http\Controllers\Api\WarehouseTypeController;
use App\Http\Controllers\Api\aprController;
use App\Http\Controllers\Api\BrigadeController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

Route::resource('buhtas', BhtController::class);
Route::resource('types', TypeController::class);
Route::resource('thicknesse', ThicknesseController::class);
Route::resource('counterparties', CounterpartiesController::class);
Route::resource('warehouse', WarehouseController::class);
Route::resource('warehousetype', warehouseTypeController::class);
Route::resource('apr', aprController::class);
Route::resource('brigade', BrigadeController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    dd($request);
    return $request->user();
});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout')->middleware('auth:sanctum');
