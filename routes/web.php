<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Admin\BackupController;

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

Route::get('/pelatihan', [PelatihanController::class, 'index'])->name('pelatihan.index');
Route::get('/pelatihan/{pelatihan}', [PelatihanController::class, 'show'])->name('pelatihan.show');
Route::get('/pelatihan/rating', [PelatihanController::class, 'rating'])->name('pelatihan.rating');
Route::get('/pelatihan/edit', [PelatihanController::class, 'edit'])->name('pelatihan.edit');

//sementara gini dulu lahya
Route::get('/mahasiswa/profile', [MahasiswaController::class, 'show'])->name('mahasiswa.profile');
Route::get('/mahasiswa/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::get('/mahasiswa/status_loker', [MahasiswaController::class, 'status_loker'])->name('mahasiswa.status_loker');
Route::get('/mahasiswa/portofolio', [MahasiswaController::class, 'portofolio'])->name('mahasiswa.portofolio');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/kelola_user', [PageController::class, 'kelola_user'])->name('admin.kelola.user');
        Route::get('/audit_loker', [PageController::class, 'audit_loker'])->name('admin.audit.loker');
        Route::get('/audit_pelatihan', [PageController::class, 'audit_pelatihan'])->name('admin.audit.pelatihan');
        Route::get('/audit_mitra', [PageController::class, 'audit_mitra'])->name('admin.audit.mitra');
        Route::get('/kelola_pelatihan', [PageController::class, 'kelola_pelatihan'])->name('admin.kelola.pelatihan');

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

// Di routes/web.php (temporary, HAPUS setelah selesai!)
Route::get('/test-backup', function() {
    try {
        // Test 1: Cek mysqldump
        $dumpPath = config('database.connections.mysql.dump.dump_binary_path');
        $mysqldumpExists = file_exists($dumpPath . '/mysqldump.exe') || file_exists($dumpPath . '/mysqldump');

        // Test 2: Cek disk backups
        $disk = Storage::disk('backups');
        $diskExists = $disk->exists('');

        // Test 3: Cek permission
        $backupPath = storage_path('app/backups');
        $canWrite = is_writable($backupPath);

        // Test 4: PHP Settings
        $maxExecution = ini_get('max_execution_time');
        $memoryLimit = ini_get('memory_limit');

        return response()->json([
            'mysqldump_path' => $dumpPath,
            'mysqldump_exists' => $mysqldumpExists,
            'disk_accessible' => $diskExists,
            'backup_path' => $backupPath,
            'can_write' => $canWrite,
            'max_execution_time' => $maxExecution,
            'memory_limit' => $memoryLimit,
            'db_connection' => config('database.default'),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ], 500);
    }
})->middleware('auth');
