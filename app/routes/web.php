<?php

use Illuminate\Support\Facades\Route;

// Route::get();
Route::post('login', 'AuthController@login')->name('login');

// Route::group(['middleware' => 'auth',], function () {
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');

    Route::get('/{any}', function() {
    return view('index');
    })->where('any','.*');
// });
