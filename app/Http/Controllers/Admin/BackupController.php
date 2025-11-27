<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BackupController extends Controller
{
    public function index()
    {
        try {
            // 1. Ambil semua file dari disk 'backups'
            $disk = Storage::disk('backups');

            // Cek apakah disk dapat diakses
            if (!$disk->exists('')) {
                return view('page.admin.backup', [
                    'backups' => [],
                    'error' => 'Direktori backup tidak dapat diakses. Pastikan konfigurasi disk "backups" sudah benar.'
                ]);
            }

            $files = $disk->allFiles();
            $backups = [];

            // 2. Loop data untuk ditampilkan di Tabel HTML
            foreach ($files as $f) {
                // Hanya ambil file .zip
                if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                    $backups[] = [
                        'file_path' => $f,
                        'file_name' => basename($f),
                        'file_size' => $this->formatSize($disk->size($f)),
                        'last_modified' => Carbon::createFromTimestamp($disk->lastModified($f))->format('d M Y, H:i'),
                    ];
                }
            }

            // Urutkan dari yang terbaru
            usort($backups, function($a, $b) {
                return strcmp($b['last_modified'], $a['last_modified']);
            });

            return view('page.admin.backup', compact('backups'));

        } catch (\Exception $e) {
            Log::error('Backup index error: ' . $e->getMessage());
            return view('page.admin.backup', [
                'backups' => [],
                'error' => 'Gagal memuat daftar backup: ' . $e->getMessage()
            ]);
        }
    }

    // Fungsi untuk Tombol "Buat Backup Baru"
    public function create(Request $request)
    {
        // Validasi input
        $request->validate([
            'type' => 'required|in:database,full'
        ]);

        // PENTING: Backup butuh waktu, set time limit jadi unlimited
        set_time_limit(0);
        ini_set('memory_limit', '512M');

        $option = $request->input('type');

        try {
            // Pastikan direktori backup dan temp ada
            $backupPath = storage_path('app/backups/Laravel');
            $tempPath = storage_path('app/backup-temp');

            if (!file_exists($backupPath)) {
                mkdir($backupPath, 0755, true);
            }

            if (!file_exists($tempPath)) {
                mkdir($tempPath, 0755, true);
            }

            // Log sebelum backup
            Log::info('Starting backup via web. Type: ' . $option);
            Log::info('PHP Version: ' . PHP_VERSION);
            Log::info('Running as: ' . (php_sapi_name()));

            // SOLUSI: Gunakan shell_exec dengan PHP binary explicit
            // Ini memastikan environment yang benar untuk mysqldump
            $phpBinary = 'C:/laragon/bin/php/php-8.2.28-Win32-vs16-x64/php.exe';
            $artisanPath = base_path('artisan');

            // Cek apakah PHP binary ada
            if (!file_exists($phpBinary)) {
                // Fallback ke PHP_BINARY konstanta
                $phpBinary = PHP_BINARY;
            }

            // Build command
            if ($option == 'database') {
                $command = sprintf(
                    '"%s" "%s" backup:run --only-db --disable-notifications 2>&1',
                    $phpBinary,
                    $artisanPath
                );
            } else {
                $command = sprintf(
                    '"%s" "%s" backup:run --disable-notifications 2>&1',
                    $phpBinary,
                    $artisanPath
                );
            }

            Log::info('Command: ' . $command);

            // Jalankan command dengan proc_open untuk kontrol lebih baik
            $descriptorspec = [
                0 => ['pipe', 'r'],  // stdin
                1 => ['pipe', 'w'],  // stdout
                2 => ['pipe', 'w']   // stderr
            ];

            $process = proc_open($command, $descriptorspec, $pipes, base_path());

            if (!is_resource($process)) {
                throw new \Exception('Gagal menjalankan backup command. Cek permission PHP.');
            }

            // Tutup stdin
            fclose($pipes[0]);

            // Baca stdout
            $output = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            // Baca stderr
            $errors = stream_get_contents($pipes[2]);
            fclose($pipes[2]);

            // Tunggu process selesai
            $returnCode = proc_close($process);

            Log::info('Backup return code: ' . $returnCode);
            Log::info('Backup output: ' . $output);

            if (!empty($errors)) {
                Log::error('Backup errors: ' . $errors);
            }

            // Cek apakah backup berhasil
            if (empty($output)) {
                throw new \Exception('Backup tidak menghasilkan output. Cek permission atau path PHP.');
            }

            if ($returnCode !== 0 || str_contains($output, 'Backup failed')) {
                $errorDetail = !empty($errors) ? $errors : substr($output, 0, 500);
                throw new \Exception('Backup gagal. Detail: ' . $errorDetail);
            }

            // Cek apakah output menunjukkan backup berhasil
            if (str_contains($output, 'Backup completed') || str_contains($output, 'Successfully copied')) {
                Log::info('Backup completed successfully via shell_exec');

                // Verifikasi file backup baru dibuat
                $disk = Storage::disk('backups');
                $files = collect($disk->allFiles())->filter(function($file) {
                    return substr($file, -4) === '.zip';
                })->sortByDesc(function($file) use ($disk) {
                    return $disk->lastModified($file);
                });

                $latestBackup = $files->first();

                if ($latestBackup) {
                    return redirect()->back()->with('success', 'Backup berhasil dibuat! File: ' . basename($latestBackup));
                }

                return redirect()->back()->with('success', 'Backup berhasil dibuat!');
            }

            // Jika sampai sini, kemungkinan ada warning tapi backup mungkin berhasil
            Log::warning('Backup finished but status unclear. Output: ' . substr($output, 0, 200));
            return redirect()->back()->with('warning', 'Backup selesai. Refresh halaman untuk melihat hasil.');

        } catch (\Exception $e) {
            Log::error('Backup failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect()->back()->with('error', 'Gagal melakukan backup: ' . $e->getMessage());
        }
    }

    // Fungsi Download File
    public function download($fileName)
    {
        try {
            $disk = Storage::disk('backups');

            // Security: Validasi file name untuk mencegah path traversal
            $fileName = basename($fileName);

            // Cari file di semua lokasi
            $allFiles = $disk->allFiles();
            $filePath = null;

            foreach ($allFiles as $file) {
                if (basename($file) === $fileName && substr($file, -4) === '.zip') {
                    $filePath = $file;
                    break;
                }
            }

            if (!$filePath || !$disk->exists($filePath)) {
                return redirect()->back()->with('error', 'File backup tidak ditemukan.');
            }

            // Return download response
            return $disk->download($filePath);

        } catch (\Exception $e) {
            Log::error('Download failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal download: ' . $e->getMessage());
        }
    }

    // Fungsi Hapus File
    public function delete($fileName)
    {
        try {
            $disk = Storage::disk('backups');

            // Security: Validasi file name
            $fileName = basename($fileName);

            // Cari file di semua lokasi
            $allFiles = $disk->allFiles();
            $filePath = null;

            foreach ($allFiles as $file) {
                if (basename($file) === $fileName && substr($file, -4) === '.zip') {
                    $filePath = $file;
                    break;
                }
            }

            if (!$filePath || !$disk->exists($filePath)) {
                return redirect()->back()->with('error', 'File tidak ditemukan.');
            }

            // Hapus file
            $disk->delete($filePath);

            Log::info('Backup deleted: ' . $filePath);

            return redirect()->back()->with('success', 'File backup berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Delete failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    // Helper Format Ukuran Byte ke MB/GB
    private function formatSize($bytes)
    {
        if ($bytes == 0) return '0 B';

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = floor(log($bytes, 1024));

        return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
    }
}
