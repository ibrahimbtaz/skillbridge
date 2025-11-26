<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BackupController extends Controller
{
    public function index()
    {
        // 1. Ambil semua file dari disk 'backups'
        $disk = Storage::disk('backups');
        $files = $disk->files();
        $backups = [];

        // 2. Loop data untuk ditampilkan di Tabel HTML
        foreach ($files as $k => $f) {
            // Hanya ambil file .zip
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace('Laravel/', '', $f), // Bersihkan nama
                    'file_size' => $this->formatSize($disk->size($f)),
                    'last_modified' => Carbon::createFromTimestamp($disk->lastModified($f))->format('d M Y, H:i'),
                ];
            }
        }

        // Urutkan dari yang terbaru
        $backups = array_reverse($backups);

        return view('page.admin.kelola.backup', compact('backups'));
    }

    // Fungsi untuk Tombol "Buat Backup Baru"
    public function create(Request $request)
    {
        // PENTING: Backup butuh waktu, set time limit jadi unlimited
        set_time_limit(0); 

        $option = $request->input('type'); // 'database' atau 'full'

        try {
            if ($option == 'database') {
                // Hanya backup DB (--only-db)
                Artisan::call('backup:run --only-db --disable-notifications');
            } else {
                // Full backup (File + DB)
                Artisan::call('backup:run --disable-notifications');
            }

            return redirect()->back()->with('success', 'Backup berhasil dibuat!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal backup: ' . $e->getMessage());
        }
    }

    // Fungsi Download File
    public function download($fileName)
    {
        return Storage::disk('backups')->download($fileName);
    }

    // Fungsi Hapus File
    public function delete($fileName)
    {
        $disk = Storage::disk('backups');
        if ($disk->exists($fileName)) {
            $disk->delete($fileName);
            return redirect()->back()->with('success', 'File backup dihapus.');
        }
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    // Helper Format Ukuran Byte ke MB/GB
    private function formatSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
