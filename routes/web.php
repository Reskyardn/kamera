<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Auth Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Logout (Authenticated)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Redirect root to dashboard
Route::get('/', function () {
    return auth()->check() ? redirect()->route('admin.dashboard') : redirect()->route('login');
});

// All Authenticated Routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    // Peminjaman & Pengembalian - Accessible by all authenticated users
    Route::resource('peminjaman', App\Http\Controllers\Admin\PeminjamanController::class, ['names' => 'admin.peminjaman']);
    Route::resource('pengembalian', App\Http\Controllers\Admin\PengembalianController::class, ['names' => 'admin.pengembalian']);
    
    // Admin Only Routes - Protected by middleware
    Route::middleware('admin')->group(function () {
        Route::resource('kameras', App\Http\Controllers\Admin\KameraController::class, ['names' => 'admin.kameras']);
        Route::resource('users', App\Http\Controllers\Admin\UserController::class, ['names' => 'admin.users']);
    });
});
