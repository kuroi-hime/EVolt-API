<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\BorneController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'store'])->name('user.add');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');
    Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');
    Route::patch('/edit/{user}', [UserController::class, 'update'])->name('user.edit');
    Route::get('/users', [UserController::class, 'index'])->name('users');
});

Route::get('/bornes', [BorneController::class, 'index'])->name('bornes');
Route::post('/bornes/{id}/reserver', [ReservationController::class, 'store'])->name('reservation.add');
Route::post('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservation.edit');