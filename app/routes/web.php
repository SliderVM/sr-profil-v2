<?php

use App\Http\Controllers\Api\BhtController;
use App\Http\Controllers\Api\shtripsController;
use Illuminate\Support\Facades\Route;

Route::view('login', 'welcome');
Route::post('login', 'AuthController@login')->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');
    Route::post('groupshtrips', 'Api\shtripsController@groupShtrips');
    Route::post('shtripstransfer', [shtripsController::class, 'stripsTransfer']);
    Route::post('shtripsreceipt', 'Api\shtripsController@stripsReceipt');
    Route::post('shtripscancel/{id}', [shtripsController::class, 'stripsCancel']);
    Route::post('history', [BhtController::class, 'history']);
    Route::get('shtripshistory/{id}', [shtripsController::class, 'shtripsHistory']);
    Route::post('showOutfitStripping', 'Api\shtripsController@showOutfitStripping');
    Route::post('shtripsnum/{id}', 'Api\shtripsController@warehouseNum');
    Route::post('sumshtrips/{id}', 'Api\shtripsController@sumshtrips');
    Route::post('register', 'AuthController@register');
    Route::get('/{any}', function() {
        return view('index');
    })->where('any','.*');
});




