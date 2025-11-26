<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup & Restore - Skill Bridge Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800">

    <div class="flex h-screen">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white flex flex-col shadow-lg hidden md:flex">
            <div class="h-16 flex items-center justify-center border-b border-blue-800">
                <h1 class="text-2xl font-bold tracking-wider">Skill Bridge</h1>
            </div>
            <nav class="flex-1 px-2 py-4 space-y-2 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span>Dashboard</span>
                </a>
                
                <p class="px-4 text-xs text-gray-400 uppercase mt-4 mb-2 font-semibold">Manajemen</p>
                <a href="{{ route('admin.kelola.user') }}" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-user-graduate w-6"></i>
                    <span>Kelola User</span>
                </a>

                <p class="px-4 text-xs text-gray-400 uppercase mt-4 mb-2 font-semibold">Audit & Validasi</p>
                <a href="{{ route('admin.audit.loker') }}" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-briefcase w-6"></i>
                    <span>Audit Loker</span>
                </a>
                <a href="{{ route('admin.audit.pelatihan') }}" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-chalkboard-teacher w-6"></i>
                    <span>Audit Pelatihan</span>
                </a>
                <a href="{{ route('admin.kelola.pelatihan') }}" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-book w-6"></i>
                    <span>Kelola Pelatihan</span>
                </a>

                <p class="px-4 text-xs text-gray-400 uppercase mt-4 mb-2 font-semibold">Sistem</p>
                <a href="{{ route('admin.backup.index') }}" class="flex items-center px-4 py-3 bg-blue-800 rounded-lg transition-colors text-white shadow-inner">
                    <i class="fas fa-database w-6 mr-2"></i>
                    <span>Backup Data</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Header -->
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Backup & Restore Database</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</div>
                </div>
            </header>

            <!-- Content -->
            <div class="flex-1 overflow-y-auto p-6 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-3 rounded-lg text-white shadow-lg">
                    <i class="fas fa-shield-alt text-xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Database Backup & Restore</h1>
                    <p class="text-gray-600 mt-1">Kelola keamanan data Skill Bridge secara berkala</p>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 px-5 py-4 rounded-lg mb-6 flex items-center gap-3 shadow-sm">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="font-semibold">Sukses!</p>
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-800 px-5 py-4 rounded-lg mb-6 flex items-center gap-3 shadow-sm">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                </div>
                <div>
                    <p class="font-semibold">Error!</p>
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100">
                <div class="h-1 bg-gradient-to-r from-green-400 to-emerald-500"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Status Sistem</p>
                            <h3 class="text-2xl font-bold text-gray-900 mt-2">Aman & Stabil</h3>
                            <p class="text-xs text-gray-500 mt-2">Sistem berjalan normal</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded-lg text-green-600 text-xl">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Last Backup Card -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100">
                <div class="h-1 bg-gradient-to-r from-blue-400 to-cyan-500"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Backup Terakhir</p>
                            <h3 class="text-2xl font-bold text-gray-900 mt-2">
                                @if(count($backups ?? []) > 0)
                                    {{ \Carbon\Carbon::createFromTimestamp(filemtime(storage_path('app/backups/' . $backups[0]['file_path'])))->diffForHumans() }}
                                @else
                                    Belum Ada
                                @endif
                            </h3>
                            <p class="text-xs text-gray-500 mt-2">
                                @if(count($backups ?? []) > 0)
                                    {{ \Carbon\Carbon::createFromTimestamp(filemtime(storage_path('app/backups/' . $backups[0]['file_path'])))->format('d M Y H:i') }}
                                @else
                                    Buat backup pertama Anda
                                @endif
                            </p>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-lg text-blue-600 text-xl">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Backup Card -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100">
                <div class="h-1 bg-gradient-to-r from-purple-400 to-pink-500"></div>
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Total Backup</p>
                            <h3 class="text-2xl font-bold text-gray-900 mt-2">{{ count($backups ?? []) }}</h3>
                            <p class="text-xs text-gray-500 mt-2">File backup tersimpan</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded-lg text-purple-600 text-xl">
                            <i class="fas fa-database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Backup Actions Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                    <i class="fas fa-plus-circle text-lg"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Buat Backup Baru</h2>
            </div>
            <p class="text-gray-600 mb-6">Pilih jenis backup yang ingin dilakukan. Proses ini memakan waktu beberapa menit tergantung ukuran data.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Database Backup -->
                <form method="POST" action="{{ route('admin.backup.create') }}" onsubmit="return confirm('Mulai backup database SQL? Prosesnya akan memakan waktu beberapa menit.');">
                    @csrf
                    <input type="hidden" name="type" value="database">
                    <button type="submit" class="w-full group">
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 border-2 border-blue-200 hover:border-blue-400 hover:from-blue-100 hover:to-cyan-100 rounded-xl p-5 transition-all duration-300 cursor-pointer shadow-sm hover:shadow-md">
                            <div class="flex items-center gap-4">
                                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-4 rounded-lg text-white shadow-lg group-hover:shadow-xl transition-all">
                                    <i class="fas fa-database text-2xl"></i>
                                </div>
                                <div class="text-left flex-1">
                                    <h3 class="font-bold text-gray-900 text-lg">Database Saja (SQL)</h3>
                                    <p class="text-sm text-gray-600 mt-1">Backup data database saja tanpa file</p>
                                    <p class="text-xs text-blue-600 font-medium mt-2">⚡ Cepat & Ringan</p>
                                </div>
                                <div class="text-2xl text-blue-400 group-hover:text-blue-600 transition">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </button>
                </form>

                <!-- Full Backup -->
                <form method="POST" action="{{ route('admin.backup.create') }}" onsubmit="return confirm('Mulai full backup? Ini akan memakan waktu lebih lama karena termasuk semua file.');">
                    @csrf
                    <input type="hidden" name="type" value="full">
                    <button type="submit" class="w-full group">
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 border-2 border-green-200 hover:border-green-400 hover:from-green-100 hover:to-emerald-100 rounded-xl p-5 transition-all duration-300 cursor-pointer shadow-sm hover:shadow-md">
                            <div class="flex items-center gap-4">
                                <div class="bg-gradient-to-br from-green-500 to-emerald-600 p-4 rounded-lg text-white shadow-lg group-hover:shadow-xl transition-all">
                                    <i class="fas fa-file-zipper text-2xl"></i>
                                </div>
                                <div class="text-left flex-1">
                                    <h3 class="font-bold text-gray-900 text-lg">Full Backup (DB + Files)</h3>
                                    <p class="text-sm text-gray-600 mt-1">Backup database dan semua file aplikasi</p>
                                    <p class="text-xs text-green-600 font-medium mt-2">🔒 Lengkap & Aman</p>
                                </div>
                                <div class="text-2xl text-green-400 group-hover:text-green-600 transition">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </button>
                </form>
            </div>
        </div>

        <!-- Backup History -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="bg-purple-100 p-2 rounded-lg text-purple-600">
                        <i class="fas fa-history text-lg"></i>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">Riwayat Backup</h2>
                </div>
                <span class="bg-white px-3 py-1 rounded-full text-sm font-semibold text-gray-700 shadow-sm border border-gray-200">{{ count($backups ?? []) }} file</span>
            </div>
            
            @if(count($backups ?? []) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr class="text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                <th class="px-8 py-4">Nama File</th>
                                <th class="px-8 py-4">Tanggal & Waktu</th>
                                <th class="px-8 py-4">Ukuran</th>
                                <th class="px-8 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($backups as $index => $backup)
                                <tr class="hover:bg-blue-50 transition-colors duration-200 group">
                                    <td class="px-8 py-5 font-medium text-gray-900">
                                        <div class="flex items-center gap-3">
                                            @if(strpos($backup['file_name'], '.zip'))
                                                <div class="bg-green-100 p-2 rounded-lg text-green-600 group-hover:scale-110 transition-transform">
                                                    <i class="fas fa-file-zipper"></i>
                                                </div>
                                            @else
                                                <div class="bg-blue-100 p-2 rounded-lg text-blue-600 group-hover:scale-110 transition-transform">
                                                    <i class="fas fa-file-code"></i>
                                                </div>
                                            @endif
                                            <span class="truncate">{{ $backup['file_name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-gray-600 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span>{{ $backup['last_modified'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-gray-600">
                                        <span class="bg-gray-100 px-3 py-1 rounded-full text-sm font-medium">{{ $backup['file_size'] }}</span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <a href="{{ route('admin.backup.download', ['fileName' => $backup['file_path']]) }}" class="inline-flex items-center gap-2 bg-blue-50 hover:bg-blue-100 text-blue-600 hover:text-blue-700 px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 shadow-sm hover:shadow-md">
                                                <i class="fas fa-download"></i> Unduh
                                            </a>
                                            <form method="POST" action="{{ route('admin.backup.delete', ['fileName' => $backup['file_path']]) }}" style="display:inline;" onsubmit="return confirm('Hapus file backup ini secara permanen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 shadow-sm hover:shadow-md">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                        <!-- Mobile fallback -->
                                        <div class="md:hidden flex justify-end gap-1">
                                            <a href="{{ route('admin.backup.download', ['fileName' => $backup['file_path']]) }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.backup.delete', ['fileName' => $backup['file_path']]) }}" style="display:inline;" onsubmit="return confirm('Hapus file backup ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-700 font-medium text-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-16">
                    <div class="mb-4">
                        <i class="fas fa-box-open text-6xl text-gray-300 mb-4 block"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Backup</h3>
                    <p class="text-gray-600 mb-6">Mulai dengan membuat backup pertama Anda untuk melindungi data Skill Bridge</p>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 inline-block text-sm text-blue-700">
                        <i class="fas fa-info-circle mr-2"></i> Klik tombol "Backup Baru" di atas untuk memulai
                    </div>
                </div>
            @endif
        </div>
        </div>
    </div>
</body>
</html>