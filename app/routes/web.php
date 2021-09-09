<?php

use App\Http\Controllers\Api\shtripsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::view('login', 'welcome');

Route::post('login', 'AuthController@login')->name('login');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');
    Route::get('groupshtrips/{id}', 'Api\shtripsController@groupShtrips');
    Route::get('histories', 'Api\BhtController@histories');
    Route::post('history/{id}', 'Api\BhtController@history');
    Route::post('showOutfitStripping', 'Api\shtripsController@showOutfitStripping');
    Route::post('shtripsnum/{id}', 'Api\shtripsController@warehouseNum');
    Route::post('sumshtrips/{id}', 'Api\shtripsController@sumshtrips');
    Route::post('register', 'AuthController@register');
    Route::get('/{any}', function() {
        return view('index');
    })->where('any','.*');
});




