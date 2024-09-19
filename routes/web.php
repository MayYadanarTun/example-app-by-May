<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('paypal', array('as' => 'status','uses' => 'CheckoutController@getPaymentStatus',));

Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::post('/checkout', 'CheckoutController@payment');
Route::post('/charge', 'CheckoutController@charge');
Route::get('/checkout/confirmation', 'CheckoutController@confirmation')->name('confirmation');

