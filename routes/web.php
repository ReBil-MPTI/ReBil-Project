<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CarCrud\Cars;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::view('/', 'dashboard')->name('dashboard');
        Route::view('/profile', 'profile')->name('profile');
        Route::get('/mobil', Cars::class)->name('cars.index');
    });
});

require __DIR__ . '/auth.php';
