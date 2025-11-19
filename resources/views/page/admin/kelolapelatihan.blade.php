<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pelatihan - Skill Bridge Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .modal { transition: opacity 0.25s ease; }
        body.modal-active { overflow: hidden; }
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
                <a href="#" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-user-graduate w-6"></i>
                    <span>Mahasiswa</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-building w-6"></i>
                    <span>Mitra Industri</span>
                </a>

                <p class="px-4 text-xs text-gray-400 uppercase mt-4 mb-2 font-semibold">Audit & Validasi</p>
                <a href="admin-audit-loker.html" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
                    <i class="fas fa-briefcase w-6"></i>
                    <span>Audit Loker</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 bg-blue-800 rounded-lg transition-colors text-white shadow-inner">
                    <div class="flex items-center">
                        <i class="fas fa-chalkboard-teacher w-6"></i>
                        <span>Audit Pelatihan</span>
                    </div>
                    <span class="bg-purple-500 text-xs px-2 py-0.5 rounded-full ml-auto">5</span>
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
                <h2 class="text-xl font-bold text-gray-800">Manajemen & Audit Pelatihan</h2>
                <div class="flex items-center space-x-4">
                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">A</div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6 bg-gray-50">
                
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    
                    <div class="flex bg-white p-1 rounded-lg border border-gray-200 shadow-sm">
                        <button class="px-4 py-2 bg-blue-100 text-blue-700 rounded-md text-sm font-bold shadow-sm">
                            Pending Audit (5)
                        </button>
                        <button class="px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-md text-sm font-medium transition-colors">
                            Pelatihan Aktif (24)
                        </button>
                        <button class="px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-md text-sm font-medium transition-colors">
                            Ditolak/Arsip
                        </button>
                    </div>

                    <div class="relative w-full md:w-80">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" placeholder="Cari judul course..." class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-100 text-xs uppercase font-bold text-gray-600 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4">Course & Mitra</th>
                                <th class="px-6 py-4">Kategori & Level</th>
                                <th class="px-6 py-4">Harga</th>
                                <th class="px-6 py-4">Tanggal Submit</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-12 w-12 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                            <img src="https://via.placeholder.com/100?text=Python" alt="Course" class="h-full w-full object-cover">
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800 line-clamp-1">Dasar Python utk Data Science</div>
                                            <div class="text-xs text-blue-600 font-semibold">Oleh: CodeAcademy ID</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-700">Programming</div>
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded">Beginner</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800">Gratis</div>
                                </td>
                                <td class="px-6 py-4">21 Nov 2025</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold border border-yellow-200">
                                        Pending
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button onclick="toggleModal('modal-course')" class="bg-indigo-600 text-white px-3 py-1.5 rounded text-xs hover:bg-indigo-700 transition shadow-sm">
                                        Validasi
                                    </button>
                                </td>
                            </tr>

                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-12 w-12 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                            <img src="https://via.placeholder.com/100?text=Marketing" alt="Course" class="h-full w-full object-cover">
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800 line-clamp-1">Digital Marketing 101</div>
                                            <div class="text-xs text-blue-600 font-semibold">Oleh: MarketMinds</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-700">Marketing</div>
                                    <span class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded">Intermediate</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800">Rp 150.000</div>
                                </td>
                                <td class="px-6 py-4">20 Nov 2025</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold border border-yellow-200">
                                        Pending
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button onclick="toggleModal('modal-course')" class="bg-indigo-600 text-white px-3 py-1.5 rounded text-xs hover:bg-indigo-700 transition shadow-sm">
                                        Validasi
                                    </button>
                                </td>
                            </tr>

                             <tr class="bg-gray-50 opacity-70 hover:opacity-100 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-12 w-12 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden">
                                            <img src="https://via.placeholder.com/100?text=UIUX" alt="Course" class="h-full w-full object-cover">
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800 line-clamp-1">UI/UX Design Fundamentals</div>
                                            <div class="text-xs text-gray-500">Oleh: CreativeHub</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-700">Design</div>
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded">Beginner</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-800">Rp 99.000</div>
                                </td>
                                <td class="px-6 py-4">10 Nov 2025</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">
                                        Aktif
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center flex justify-center gap-2">
                                    <button class="text-gray-400 hover:text-blue-600" title="Edit"><i class="fas fa-edit"></i></button>
                                    <button class="text-gray-400 hover:text-red-600" title="Hapus"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div id="modal-course" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-60"></div>
        
        <div class="modal-container bg-white w-11/12 md:max-w-3xl mx-auto rounded-xl shadow-2xl z-50 overflow-y-auto max-h-[90vh] animate-fade-in-up">
            
            <div class="relative h-40 bg-gray-200 overflow-hidden">
                <img src="https://via.placeholder.com/800x200?text=Course+Banner+Preview" alt="Banner" class="w-full h-full object-cover opacity-90">
                <div class="absolute top-0 right-0 p-4 cursor-pointer z-10" onclick="toggleModal('modal-course')">
                    <div class="bg-black bg-opacity-50 rounded-full h-8 w-8 flex items-center justify-center text-white hover:bg-red-600 transition">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/70 to-transparent p-6">
                    <h3 class="text-2xl font-bold text-white">Dasar Python untuk Data Science</h3>
                    <p class="text-gray-200 text-sm">Diajukan oleh: <span class="font-bold text-white">CodeAcademy ID</span></p>
                </div>
            </div>

            <div class="px-8 py-6">
                <div class="grid grid-cols-3 gap-6 mb-6">
                    <div class="col-span-2 space-y-4">
                        <div>
                            <h4 class="font-bold text-gray-800 mb-2">Deskripsi Pelatihan</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Pelatihan ini dirancang untuk pemula yang ingin memasuki dunia Data Science. Materi mencakup sintaks dasar Python, library Pandas, NumPy, dan visualisasi data menggunakan Matplotlib. Durasi belajar sekitar 4 minggu dengan 2x sesi live mentoring.
                            </p>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-2">Silabus Ringkas</h4>
                            <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
                                <li>Minggu 1: Pengenalan Python & Environment</li>
                                <li>Minggu 2: Struktur Data & Logika Pemrograman</li>
                                <li>Minggu 3: Manipulasi Data dengan Pandas</li>
                                <li>Minggu 4: Studi Kasus & Final Project</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-span-1 bg-gray-50 p-4 rounded-lg border border-gray-100 h-fit">
                        <div class="space-y-3">
                            <div>
                                <span class="text-xs text-gray-500 uppercase font-bold">Kategori</span>
                                <div class="font-semibold text-gray-800">Programming / IT</div>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500 uppercase font-bold">Level</span>
                                <div class="font-semibold text-gray-800">Beginner</div>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500 uppercase font-bold">Harga</span>
                                <div class="font-bold text-blue-600 text-lg">Gratis</div>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500 uppercase font-bold">Link Materi</span>
                                <a href="#" class="text-blue-500 text-sm hover:underline block truncate">drive.google.com/materi...</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                    <div class="w-1/2 pr-4">
                        <input type="text" placeholder="Alasan jika ditolak..." class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-200 focus:border-red-400 outline-none">
                    </div>
                    <div class="flex gap-3">
                        <button class="px-5 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-bold hover:bg-red-100 border border-red-100 transition">
                            <i class="fas fa-times mr-2"></i> Tolak
                        </button>
                        <button class="px-5 py-2 bg-green-600 text-white rounded-lg text-sm font-bold hover:bg-green-700 shadow-lg transition transform hover:scale-105">
                            <i class="fas fa-check mr-2"></i> Setujui & Publish
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function toggleModal(modalID){
            const modal = document.getElementById(modalID);
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
            document.body.classList.toggle('modal-active');
        }

        document.querySelectorAll('.modal-overlay').forEach(function(elem) {
            elem.addEventListener('click', function(event) {
                const modal = event.target.closest('.modal');
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
                document.body.classList.remove('modal-active');
            });
        });
    </script>
</body>
</html>