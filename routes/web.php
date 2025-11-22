<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReservationController as AdminReservation;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Routes (Authenticated)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Reservasi User
    Route::get('/rooms/{room}', [DashboardController::class, 'showRoom'])->name('rooms.show');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/my-reservations', [ReservationController::class, 'history'])->name('reservations.history');
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
});

// Admin Routes (Auth + Role:Admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Manajemen Ruang
    Route::resource('rooms', RoomController::class);
    
    // Manajemen User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/promote', [UserController::class, 'promote'])->name('users.promote');
    
    // Manajemen Semua Reservasi
    Route::get('/reservations', [AdminReservation::class, 'index'])->name('reservations.index');
    Route::patch('/reservations/{reservation}/cancel', [AdminReservation::class, 'cancel'])->name('reservations.cancel');
});