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
            Log::info('OS: ' . PHP_OS);

            // Deteksi environment
            $isDocker = $this->isRunningInDocker();
            $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
            Log::info('Is Docker: ' . ($isDocker ? 'Yes' : 'No'));
            Log::info('Is Windows: ' . ($isWindows ? 'Yes' : 'No'));

            $exitCode = null;
            $outputText = '';

            // Di Windows lokal, HARUS gunakan shell execution karena:
            // - Web server (Apache) tidak bisa create TCP socket untuk mysqldump
            // - PHP CLI bisa create socket dengan sempurna
            // Di Docker, Artisan::call() berfungsi normal
            if ($isWindows && !$isDocker) {
                Log::info('Windows detected: Using shell execution to avoid socket issues');

                // Langsung gunakan shell method untuk Windows
                $artisanPath = base_path('artisan');

                // Cari PHP binary
                $possiblePaths = [
                    'C:/laragon/bin/php/php-8.2.28-Win32-vs16-x64/php.exe',
                    'C:/laragon/bin/php/php-8.2/php.exe',
                    'C:/laragon/bin/php/php-8.3/php.exe',
                    'C:/laragon/bin/php/php-8.1/php.exe',
                ];
                $phpBinary = null;
                foreach ($possiblePaths as $path) {
                    if (file_exists($path)) {
                        $phpBinary = $path;
                        break;
                    }
                }

                // Fallback: cari di folder Laragon
                if (!$phpBinary) {
                    $laravelPhpDir = 'C:/laragon/bin/php';
                    if (is_dir($laravelPhpDir)) {
                        $dirs = glob($laravelPhpDir . '/php-*', GLOB_ONLYDIR);
                        if (!empty($dirs)) {
                            rsort($dirs); // Ambil versi terbaru
                            $phpBinary = $dirs[0] . '/php.exe';
                        }
                    }
                }

                if (!$phpBinary || !file_exists($phpBinary)) {
                    throw new \Exception('PHP binary tidak ditemukan di Laragon. Path yang dicek: ' . implode(', ', $possiblePaths));
                }

                Log::info('Using PHP binary: ' . $phpBinary);

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

                // Gunakan exec() yang lebih simple untuk Windows
                $outputLines = [];
                $exitCode = 0;
                exec($command, $outputLines, $exitCode);
                $outputText = implode("\n", $outputLines);

                Log::info('Backup return code: ' . $exitCode);
                Log::info('Backup output: ' . $outputText);

            } else {
                // Docker atau Linux: gunakan Artisan::call()
                Log::info('Using Artisan::call() for backup');

                $output = new \Symfony\Component\Console\Output\BufferedOutput();

                try {
                    if ($option == 'database') {
                        $exitCode = Artisan::call('backup:run', [
                            '--only-db' => true,
                            '--disable-notifications' => true,
                        ], $output);
                    } else {
                        $exitCode = Artisan::call('backup:run', [
                            '--disable-notifications' => true,
                        ], $output);
                    }

                    $outputText = $output->fetch();
                    Log::info('Backup output: ' . $outputText);
                    Log::info('Backup exit code: ' . $exitCode);

                } catch (\Exception $artisanException) {
                    Log::error('Artisan::call failed: ' . $artisanException->getMessage());
                    throw $artisanException;
                }
            }

            // Cek apakah backup berhasil
            $outputText = $outputText ?? '';

            if ($exitCode !== 0) {
                throw new \Exception('Backup gagal dengan exit code: ' . $exitCode . '. Output: ' . substr($outputText, 0, 500));
            }

            // Verifikasi file backup baru dibuat
            $disk = Storage::disk('backups');
            $files = collect($disk->allFiles())->filter(function($file) {
                return substr($file, -4) === '.zip';
            })->sortByDesc(function($file) use ($disk) {
                return $disk->lastModified($file);
            });

            $latestBackup = $files->first();

            if ($latestBackup) {
                Log::info('Backup completed successfully. File: ' . $latestBackup);
                return redirect()->back()->with('success', 'Backup berhasil dibuat! File: ' . basename($latestBackup));
            }

            // Cek apakah output menunjukkan backup berhasil
            if (str_contains($outputText, 'Backup completed') || str_contains($outputText, 'Successfully')) {
                return redirect()->back()->with('success', 'Backup berhasil dibuat!');
            }

            // Jika sampai sini, kemungkinan ada warning tapi backup mungkin berhasil
            Log::warning('Backup finished but status unclear. Output: ' . substr($outputText, 0, 200));
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

    /**
     * Check if running inside Docker container
     */
    private function isRunningInDocker(): bool
    {
        // Method 1: Check for .dockerenv file
        if (file_exists('/.dockerenv')) {
            return true;
        }

        // Method 2: Check cgroup
        if (file_exists('/proc/1/cgroup')) {
            $cgroup = file_get_contents('/proc/1/cgroup');
            if (strpos($cgroup, 'docker') !== false || strpos($cgroup, 'kubepods') !== false) {
                return true;
            }
        }

        // Method 3: Check environment variable (set it in docker-compose if needed)
        if (env('APP_ENV_DOCKER', false)) {
            return true;
        }

        return false;
    }
}
