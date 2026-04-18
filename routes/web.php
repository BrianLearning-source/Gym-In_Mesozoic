<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');

    return view('visitor');
});

Route::get('login', function () {
    return view('memberlogin');
});

