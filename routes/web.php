<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerkembanganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');

    return view('visitor');
});

Route::get('/loginMember', [LoginController::class, 'CustomLogin']
);

Route::get('/profile', [AnggotaController::class, 'profile']);

Route::get('rewards', [AnggotaController::class, 'rewards']);

Route::get('/memberdashboard', [AnggotaController::class, 'index']);

Route::get('/progres', [PerkembanganController::class, 'index']);