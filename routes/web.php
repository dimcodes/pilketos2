<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoterAuthController;
use App\Http\Controllers\VoteController; // Controller untuk proses voting
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', [VoterAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [VoterAuthController::class, 'login'])->name('login.post');

Route::get('/vote', [VoteController::class, 'index'])->name('vote.index');
Route::post('/vote', [VoteController::class, 'store'])->name('vote.store'); 

Route::get('/preview-success', function () {
    // Kirim pesan dummy ke session lalu langsung tampilkan view home
    session()->flash('success', 'Terima kasih! Hak pilih Anda telah berhasil disimpan.');
    return view('home'); // Ganti 'home' sesuai nama file view kamu
});


Route::prefix('admin')->name('admin.')->group(function () {
    // Form Login Admin path /admin/login
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');

    // Proses Login & Logout Admin
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});