<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');

    return view('visitor');
});

Route::get('/loginMember', [LoginController::class, 'showLogin'])->name('login');
Route::post('/loginMember', [LoginController::class, 'login'])->name('login.post');

// Protected Member Routes (Wrapped in 'auth' middleware)
Route::middleware(['auth'])->prefix('member')->group(function () {
    Route::get('/memberDashboard', [AnggotaController::class, 'index'])->name('member.dashboard');
    Route::get('/profile', [AnggotaController::class, 'profile'])->name('member.profile');
    Route::get('/rewards', [AnggotaController::class, 'rewards'])->name('member.rewards');
    Route::get('/progres', [AnggotaController::class, 'perkembangan'])->name('member.progres');
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});