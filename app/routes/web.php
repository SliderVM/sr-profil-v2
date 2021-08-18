<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('login', 'AuthController@login')->name('login');

// Route::group(['middleware' => 'auth',], function () {
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout')->middleware(('auth:sanctum'));
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('histories', 'Api\BhtController@histories');
Route::post('history/{id}', 'Api\BhtController@history');

Route::get('/{any}', function() {
    return view('index');
})->where('any','.*');

