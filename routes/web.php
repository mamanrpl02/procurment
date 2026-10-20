<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('procurment.dashboard');
});


Route::get('/dashboard2', function () {
    return view('dashboard2');
});


Route::get('/supplier/dashboard', function () {
    return view('supplier.dashboard');
});
Route::get('/procurment/showlist', function () {
    return view('procurment.index');
});
Route::get('/procurment/create', function () {
    return view('procurment.create');
});
