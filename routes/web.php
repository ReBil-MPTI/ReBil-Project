<?php

use App\Livewire\CarCrud\Cars;
use App\Livewire\Transaction\IndexCar;
use App\Livewire\User\UserCRUD;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.main')->name('landing');
Route::get('/sewa-mobil', IndexCar::class)->name('cars.sewa');

Route::middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::view('/', 'dashboard')->name('dashboard');
        Route::view('/profile', 'profile')->name('profile');
        Route::get('/mobil', Cars::class)->name('cars.index');
        Route::get('/user-management', UserCRUD::class)->name('users.index');
    });
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile-user', \App\Livewire\User\Profile::class)->name('profile-user');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});


require __DIR__ . '/auth.php';
