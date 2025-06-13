<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Dashboard, hanya bisa diakses user terautentikasi dan terverifikasi email
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group route yang harus login
Route::middleware('auth')->group(function () {

    // Profile user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource route untuk incomes
    Route::resource('incomes', IncomeController::class);

    Route::get('/revenues', [RevenueController::class, 'index'])->name('revenues.index');


});

// Include route auth bawaan Laravel Breeze atau Jetstream
require __DIR__.'/auth.php';
