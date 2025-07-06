<?php

use App\Livewire\CarCrud\Cars;
use App\Livewire\User\UserCRUD;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('landing');

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
