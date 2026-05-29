<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerkembanganController;
use App\Http\Controllers\PenukaranController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');

    return view('visitor');
});

Route::get('/register', [RegistrationController::class, 'showRegistration'])->name('register');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');

Route::get('/loginMember', [LoginController::class, 'showLogin'])->name('login');
Route::post('/loginMember', [LoginController::class, 'login'])->name('login.post');

// Protected Member Routes (Wrapped in 'auth:member' middleware)
Route::middleware(['auth:member'])->prefix('member')->group(function () {
    Route::get('/memberDashboard', [AnggotaController::class, 'index'])->name('member.dashboard');
    Route::get('/profile', [AnggotaController::class, 'profile'])->name('member.profile');
    Route::get('/editProfile', [AnggotaController::class, 'editProfile'])->name('member.editProfile');
    Route::put('/updateProfile', [AnggotaController::class, 'updateProfile'])->name('member.updateProfile');
    Route::get('/rewards', [AnggotaController::class, 'rewards'])->name('member.rewards');

    Route::get('/progres', [AnggotaController::class, 'perkembangan'])->name('member.progres');
    Route::get('/progres/form', [PerkembanganController::class, 'form'])->name('member.progressForm');
    Route::post('/progres', [PerkembanganController::class, 'save'])->name('member.progressSave');
    Route::delete('/progres', [PerkembanganController::class, 'destroy'])->name('member.progressDelete');
    Route::post('/penukaran', [PenukaranController::class, 'store'])->name('member.penukaran');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});