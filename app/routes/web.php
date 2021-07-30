<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');
// Route::middleware('auth:sanctum')->group(function() {
//     Route::get('/user', 'App\Http\Controllers\AuthController@user');
// });
Route::get('/{any}', function() {
    return view('index');
})->where('any','.*');
