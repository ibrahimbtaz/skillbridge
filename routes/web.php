<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\MahasiswaController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', fn() => redirect('/'));
Route::get('/', [PageController::class, 'home'])->name('home');
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
});

Route::get('/loker', [LokerController::class, 'index'])->name('loker.index');
Route::get('/loker/{loker}', [LokerController::class, 'show'])->name('loker.show');

Route::get('/pelatihan', [PelatihanController::class, 'index'])->name('pelatihan.index');
Route::get('/pelatihan/rating', [PelatihanController::class, 'rating'])->name('pelatihan.rating');

//sementara gini dulu lahya
Route::get('/pelatihan/detail', [PelatihanController::class, 'show'])->name('pelatihan.show');
Route::get('/pelatihan/edit', [PelatihanController::class, 'edit'])->name('pelatihan.edit');

//sementara gini dulu lahya
Route::get('/mahasiswa/profile', [MahasiswaController::class, 'show'])->name('mahasiswa.profile');
Route::get('/mahasiswa/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::get('/mahasiswa/status_loker', [MahasiswaController::class, 'status_loker'])->name('mahasiswa.status_loker');
Route::get('/mahasiswa/portofolio', [MahasiswaController::class, 'portofolio'])->name('mahasiswa.portofolio');


Route::middleware(['auth', 'mitra'])->group(function () {
    Route::prefix('/mitra')->group(function () {
    Route::get('/profile', [MitraController::class, 'show'])->name('mitra.show');
    Route::get('/loker/kelola', [MitraController::class, 'kelola'])->name('mitra.loker.kelola');
    Route::get('/loker/create', [LokerController::class, 'create'])->name('mitra.loker.create');
    Route::post('/loker/store', [LokerController::class, 'store'])->name('mitra.loker.store');
    Route::get('/loker/edit/{loker}', [LokerController::class, 'edit'])->name('mitra.loker.edit');
    Route::get('/loker/show/{loker}', [LokerController::class, 'show'])->name('mitra.loker.show');
    Route::put('/loker/update/{loker}', [LokerController::class, 'update'])->name('mitra.loker.update');
    });
});

Route::get('/mitra/{id}', [MitraController::class, 'show'])->name('mitra.public');

Route::get('/notif', [PageController::class, 'notif'])->name('notif');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

