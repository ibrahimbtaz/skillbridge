<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - Skill Bridge Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .modal { transition: opacity 0.25s ease; }
        body.modal-active { overflow: hidden; }
        /* Hide scrollbar for cleaner look in tables */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="flex h-screen">
        
        <aside class="w-64 bg-blue-900 text-white flex flex-col shadow-lg hidden md:flex">
            <div class="h-16 flex items-center justify-center border-b border-blue-800">
                <h1 class="text-2xl font-bold tracking-wider">Skill Bridge</h1>
            </div>
            <nav class="flex-1 px-2 py-4 space-y-2">
                <a href="admin-dashboard.html" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span>Dashboard</span>
                </a>
                
                <p class="px-4 text-xs text-gray-400 uppercase mt-4 mb-2 font-semibold">Manajemen User</p>
                <a href="#" class="flex items-center px-4 py-3 bg-blue-800 rounded-lg transition-colors text-white shadow-inner">
                    <div class="flex items-center">
                        <i class="fas fa-users-cog w-6"></i>
                        <span>Kelola Pengguna</span>
                    </div>
                </a>

                <p class="px-4 text-xs text-gray-400 uppercase mt-4 mb-2 font-semibold">Audit & Validasi</p>
                <a href="admin-audit-loker.html" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-briefcase w-6"></i>
                    <span>Audit Loker</span>
                </a>
                <a href="admin-kelola-pelatihan.html" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-chalkboard-teacher w-6"></i>
                    <span>Audit Pelatihan</span>
                </a>

                <p class="px-4 text-xs text-gray-400 uppercase mt-4 mb-2 font-semibold">Sistem</p>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-database w-6"></i>
                    <span>Backup Data</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Manajemen Pengguna</h2>
                <div class="flex items-center space-x-4">
                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">A</div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6 bg-gray-50">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase">Total Mahasiswa</p>
                            <h3 class="text-2xl font-bold text-gray-800">1,240</h3>
                        </div>
                        <div class="h-10 w-10 bg-blue-100 rounded-full flex items-