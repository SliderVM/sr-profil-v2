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
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\shtripsController;
use App\Http\Controllers\Api\configurationController;
use App\Http\Controllers\Api\pipeController;
use App\Http\Controllers\Api\pipeQualitieController;


Route::resource('buhtas', BhtController::class);
Route::resource('types', TypeController::class);
Route::resource('thicknesse', ThicknesseController::class);
Route::resource('counterparties', CounterpartiesController::class);
Route::resource('warehouse', WarehouseController::class);
Route::resource('warehousetype', warehouseTypeController::class);
Route::resource('apr', aprController::class);
Route::resource('brigade', BrigadeController::class);
Route::resource('user', UserController::class);
Route::resource('shtrips', shtripsController::class);
Route::resource('configuration', configurationController::class);
Route::resource('pipetype', pipeController::class);
Route::resource('qualitie', pipeQualitieController::class);

