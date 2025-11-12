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
    Route::get('/loker/kelola', [MitraController::class, 'kelola'])->name('mitra.loker.kelola');
    Route::get('/loker/create', [LokerController::class, 'create'])->name('mitra.loker.create');
    Route::post('/loker/store', [LokerController::class, 'store'])->name('mitra.loker.store');
    Route::get('/loker/edit/{loker}', [LokerController::class, 'edit'])->name('mitra.loker.edit');
    Route::get('/loker/show/{loker}', [LokerController::class, 'show'])->name('mitra.loker.show');
    Route::put('/loker/update/{loker}', [LokerController::class, 'update'])->name('mitra.loker.update');
    Route::get('/loker/list', [LokerController::class, 'mitra_loker_list'])->name('mitra.loker.list');
    });
});

Route::get('/mitra/{id}', [MitraController::class, 'show'])->name('mitra.public');

//bikin route mahasiswa
Route::get('/mahasiswa/profile', [PageController::class, 'mahasiwa_profile'])->name('mahasiswa.profile');
Route::get('/mahasiswa/edit', [PageController::class, 'mahasiwa_edit'])->name('mahasiswa.edit');
Route::get('/mahasiswa/status_loker', [PageController::class, 'mahasiswa_status_loker'])->name('mahasiswa.status_loker');

Route::get('/pelatihan', [PageController::class, 'pelatihan_list'])->name('pelatihan.list');
Route::get('/pelatihan', [PageController::class, 'rating_pelatihan'])->name('rating.pelatihan');




Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

