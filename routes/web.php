<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/php-info', function() {
    phpinfo();
});

Route::get('/home', fn() => redirect('/'));
Route::get('/', [PageController::class, 'home'])->name('home');
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register/{type?}', [AuthController::class, 'register'])->name('register');
    Route::post('/register/mahasiswa', [AuthController::class, 'register_mahasiswa'])->name('mahasiswa.register');
    Route::post('/register/mitra', [AuthController::class, 'register_mitra'])->name('mitra.register');
});

Route::get('/forgot-password', [AuthController::class, 'forgot_password_form'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgot_password'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'reset_password_form'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update.token');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/change-password', [AuthController::class, 'change_password_form'])->name('password.change');
    Route::post('/change-password', [AuthController::class, 'change_password'])->name('password.update');
});

Route::get('/loker', [LokerController::class, 'index'])->name('loker.index');
Route::get('/loker/{loker}', [LokerController::class, 'show'])->name('loker.show');

// Apply loker (untuk mahasiswa yang sudah login)
Route::middleware(['auth'])->group(function () {
    Route::post('/loker/{loker}/apply', [LokerController::class, 'apply'])->name('loker.apply');
    Route::delete('/loker/{loker}/cancel', [LokerController::class, 'cancelApply'])->name('loker.cancel');
});

Route::get('/pelatihan', [PelatihanController::class, 'index'])->name('pelatihan.index');
Route::get('/pelatihan/rating', [PelatihanController::class, 'rating'])->name('pelatihan.rating');
Route::get('/pelatihan/edit', [PelatihanController::class, 'edit'])->name('pelatihan.edit');
Route::get('/pelatihan/{pelatihan}', [PelatihanController::class, 'show'])->name('pelatihan.show');

//sementara gini dulu lahya
Route::get('/mahasiswa/profile', [MahasiswaController::class, 'show'])->name('mahasiswa.profile');
Route::get('/mahasiswa/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::get('/mahasiswa/status_loker', [MahasiswaController::class, 'status_loker'])->name('mahasiswa.status_loker')->middleware('auth');
Route::get('/mahasiswa/portofolio', [MahasiswaController::class, 'portofolio'])->name('mahasiswa.portofolio');
Route::get('/mahasiswa/download-cv', [MahasiswaController::class, 'downloadCV'])->name('mahasiswa.download-cv')->middleware('auth');
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
// Route untuk melihat profil mahasiswa publik (oleh mitra) - letakkan di bawah route statis
Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'showPublic'])->name('mahasiswa.public');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/kelola_user', [AdminController::class, 'kelola_user'])->name('admin.kelola.user');
        Route::post('/kelola_user', [AdminController::class, 'store_user'])->name('admin.kelola.user.store');
        Route::get('/kelola_user/{id}/edit', [AdminController::class, 'edit_user'])->name('admin.kelola.user.edit');
        Route::put('/kelola_user/{id}', [AdminController::class, 'update_user'])->name('admin.kelola.user.update');
        Route::delete('/kelola_user/{id}', [AdminController::class, 'delete_user'])->name('admin.kelola.user.delete');

        Route::get('/audit_loker', [AdminController::class, 'audit_loker'])->name('admin.audit.loker');
        Route::get('/audit_pelatihan', [AdminController::class, 'audit_pelatihan'])->name('admin.audit.pelatihan');
        Route::get('/audit_mitra', [AdminController::class, 'audit_mitra'])->name('admin.audit.mitra');

        // Loker approval routes
        Route::post('/loker/{id}/approve', [AdminController::class, 'approve_loker'])->name('admin.loker.approve');
        Route::post('/loker/{id}/reject', [AdminController::class, 'reject_loker'])->name('admin.loker.reject');

        // Pelatihan approval routes
        Route::post('/pelatihan/{id}/approve', [AdminController::class, 'approve_pelatihan'])->name('admin.pelatihan.approve');
        Route::post('/pelatihan/{id}/reject', [AdminController::class, 'reject_pelatihan'])->name('admin.pelatihan.reject');

        Route::get('/kelola_pelatihan', [AdminController::class, 'kelola_pelatihan'])->name('admin.kelola.pelatihan');
        Route::get('/kelola_pelatihan/create', [AdminController::class, 'create_pelatihan'])->name('admin.kelola.pelatihan.create');
        Route::post('/kelola_pelatihan', [AdminController::class, 'store_pelatihan'])->name('admin.kelola.pelatihan.store');
        Route::get('/kelola_pelatihan/{id}', [AdminController::class, 'detail_pelatihan'])->name('admin.kelola.pelatihan.detail');
        Route::get('/kelola_pelatihan/{id}/edit', [AdminController::class, 'edit_pelatihan'])->name('admin.kelola.pelatihan.edit');
        Route::put('/kelola_pelatihan/{id}', [AdminController::class, 'update_pelatihan'])->name('admin.kelola.pelatihan.update');
        Route::delete('/kelola_pelatihan/{id}', [AdminController::class, 'delete_pelatihan'])->name('admin.kelola.pelatihan.delete');

        Route::prefix('backup')->name('admin.backup.')->group(function () {
            Route::get('/', [BackupController::class, 'index'])->name('index');
            Route::post('/create', [BackupController::class, 'create'])->name('create');
            Route::get('/download/{fileName}', [BackupController::class, 'download'])->name('download');
            Route::delete('/delete/{fileName}', [BackupController::class, 'delete'])->name('delete');
        });
    });
});

Route::middleware(['auth', 'mitra'])->group(function () {
    Route::prefix('/mitra')->group(function () {
    Route::get('/profile', [MitraController::class, 'show'])->name('mitra.show');
    Route::get('/edit', [MitraController::class, 'edit'])->name('mitra.edit');
    Route::put('/update/{mitra}', [MitraController::class, 'update'])->name('mitra.update');
    Route::get('/loker/kelola', [MitraController::class, 'kelola'])->name('mitra.loker.kelola');
    Route::get('/loker/create', [LokerController::class, 'create'])->name('mitra.loker.create');
    Route::post('/loker/store', [LokerController::class, 'store'])->name('mitra.loker.store');
    Route::get('/loker/edit/{loker}', [LokerController::class, 'edit'])->name('mitra.loker.edit');
    Route::get('/loker/show/{loker}', [LokerController::class, 'show'])->name('mitra.loker.show');
    Route::put('/loker/update/{loker}', [LokerController::class, 'update'])->name('mitra.loker.update');

    // Pelamar management
    Route::get('/pelamar', [MitraController::class, 'pelamar'])->name('mitra.pelamar.index');
    Route::get('/pelamar/{loker}', [MitraController::class, 'detailPelamar'])->name('mitra.pelamar.detail');
    Route::put('/pelamar/{loker}/{mahasiswa}', [MitraController::class, 'updateStatusLamaran'])->name('mitra.pelamar.update');
    });
});

Route::get('/mitra/{id}', [MitraController::class, 'show'])->name('mitra.public');

// Notification Routes
Route::middleware(['auth'])->prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', [\App\Http\Controllers\NotificationController::class, 'index'])->name('index');
    Route::get('/unread-count', [\App\Http\Controllers\NotificationController::class, 'unreadCount'])->name('unread-count');
    Route::get('/latest', [\App\Http\Controllers\NotificationController::class, 'latest'])->name('latest');
    Route::post('/{notification}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('read');
    Route::post('/mark-all-read', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
    Route::delete('/{notification}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('destroy');
    Route::delete('/', [\App\Http\Controllers\NotificationController::class, 'destroyAll'])->name('destroy-all');
});

// Legacy route (redirect to new notification page)
Route::get('/notif', fn() => redirect()->route('notifications.index'))->name('notif');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
