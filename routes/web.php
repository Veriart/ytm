<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/product', function () {
    return view('product.detail');
});

Route::get('/cart', function () {
    return view('transaction.cart');
});

Route::get('/checkout', function () {
    return view('transaction.checkout');
});
