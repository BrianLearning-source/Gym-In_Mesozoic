<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');

    return view('visitor');
});

Route::get('/loginMember', [LoginController::class, 'CustomLogin']
);

Route::get('/profile', [AnggotaController::class, 'profile']);

Route::get('rewards', function () {
    return view('rewards');
});
Route::get('/memberdashboard', [AnggotaController::class, 'index']);

Route::get('progres', function () {
    return view('progrestracker');
});