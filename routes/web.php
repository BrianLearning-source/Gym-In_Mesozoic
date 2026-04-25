<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');

    return view('visitor');
});

Route::get('/loginMember', [LoginController::class, 'CustomLogin']
);

Route::get('profile', function () {
    return view('memberprofile');
});
Route::get('rewards', function () {
    return view('rewards');
});
Route::get('member', function () {
    return view('memberdashboard');
});
Route::get('progres', function () {
    return view('progrestracker');
});