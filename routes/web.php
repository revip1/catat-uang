<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;

// Halaman beranda / landing page (kamu bisa ubah sesuai kebutuhan)
Route::get('/', function () {
    return view('dashboard'); // atau 'welcome' sesuai kamu mau
})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard, hanya bisa diakses user terautentikasi dan terverifikasi email
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group route yang harus login
Route::middleware('auth')->group(function () {

    // Profile user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource route untuk incomes
    Route::resource('incomes', IncomeController::class);

    // Revenue routes (index, generate manual, rekap tahunan)
    Route::get('revenues/annual', [RevenueController::class, 'annualReport'])->name('revenues.annual');
    Route::post('revenues/generate', [RevenueController::class, 'generateMonthlyRevenue'])->name('revenues.generate');
    Route::resource('revenues', RevenueController::class)->only(['index']);
});

// Include route auth bawaan Laravel Breeze atau Jetstream
require __DIR__.'/auth.php';
