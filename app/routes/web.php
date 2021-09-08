<?php

use App\Http\Controllers\Api\shtripsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Route::post('login', 'AuthController@login')->name('login');

// // Route::group(['middleware' => 'auth',], function () {
//
// Route::post('logout', 'AuthController@logout')->middleware(('auth:sanctum'));
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');
});

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');
Route::get('groupshtrips/{id}', 'Api\shtripsController@groupShtrips');
Route::get('histories', 'Api\BhtController@histories');
Route::post('history/{id}', 'Api\BhtController@history');
Route::post('showOutfitStripping', 'Api\shtripsController@showOutfitStripping');
Route::post('shtripsnum/{id}', 'Api\shtripsController@warehouseNum');
Route::post('sumshtrips/{id}', 'Api\shtripsController@sumshtrips');

Route::get('/{any}', function() {
    return view('index');
})->where('any','.*');

