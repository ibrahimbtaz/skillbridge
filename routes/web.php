<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\MitraController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', fn() => redirect('/'));
Route::get('/', [PageController::class, 'home'])->name('home');
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
});

Route::get('/loker', [LokerController::class, 'index'])->name('loker.index');
Route::get('/loker/{loker}', [LokerController::class, 'show'])->name('loker.show');


Route::middleware(['auth', 'mitra'])->group(function () {
    Route::prefix('/mitra')->group(function () {
        Route::get('/profile', [MitraController::class, 'show'])->name('mitra.show');
    });
});

Route::get('/mitra/{id}', [MitraController::class, 'show'])->name('mitra.public');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
