<?php

use Illuminate\Support\Facades\Route;

// Route::post('/register', 'App\Http\Controllers\AuthController@register');
// Route::post('/login', 'App\Http\Controllers\AuthController@login');
// Route::post('/logout', 'App\Http\Controllers\AuthController@logout');

Route::get('/{any}', function() {
    return view('index');
})->where('any','.*');
