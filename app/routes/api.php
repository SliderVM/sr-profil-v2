<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\bhtcontroller;
use App\Http\Controllers\Api\typecontroller;
use App\Http\Controllers\Api\thicknessecontroller;
use App\Http\Controllers\Api\counterpartiescontroller;
use App\Http\Controllers\Api\warehousecontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('buhtas', BhtController::class);
Route::resource('types', typecontroller::class);
Route::resource('thicknesse', thicknessecontroller::class);
Route::resource('counterparties', counterpartiescontroller::class);
Route::resource('warehouse', warehousecontroller::class);
