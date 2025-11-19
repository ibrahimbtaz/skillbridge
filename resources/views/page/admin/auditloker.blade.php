<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Lowongan - Skill Bridge Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        /* Transisi untuk Modal */
        .modal { transition: opacity 0.25s ease; }
        body.modal-active { overflow-x: hidden; overflow-y: hidden !important; }
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
                <a href="#" class="flex items-center px-4 py-3 bg-blue-800 rounded-lg transition-colors text-white shadow-inner">
                    <div class="flex items-center">
                        <i class="fas fa-briefcase w-6"></i>
                        <span>Audit Loker</span>
                    </div>
                    <span class="bg-red-500 text-xs px-2 py-0.5 rounded-full ml-auto">12</span>
                </a>
                <a href="#" class="flex items-center px-4 py-2 hover:bg-blue-800 rounded-lg transition-colors text-gray-300 hover:text-white">
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
                <h2 class="text-xl font-bold text-gray-800">Validasi Lowongan Pekerjaan</h2>
                <div class="flex items-center space-x-4">
                    <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">A</div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-6 bg-gray-50">
                
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <div class="relative w-full md:w-96">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" placeholder="Cari nama perusahaan atau posisi..." class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex gap-2">
                        <select class="border border-gray-300 rounded-lg px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="all">Semua Status</option>
                            <option value="pending" selected>Pending Review</option>
                            <option value="approved">Disetujui</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-100 text-xs uppercase font-bold text-gray-600 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4">Perusahaan</th>
                                    <th class="px-6 py-4">Posisi & Tipe</th>
                                    <th class="px-6 py-4">Gaji & Lokasi</th>
                                    <th class="px-6 py-4">Tanggal Submit</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 mr-3 font-bold">TM</div>
                                            <div>
                                                <div class="font-bold text-gray-800">PT Teknologi Maju</div>
                                                <div class="text-xs text-gray-500">Industri: IT Consultant</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-800">Frontend Developer</div>
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full">Magang (Intern)</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-gray-800">Rp 2.500.000</div>
                                        <div class="text-xs text-gray-500">Jakarta Selatan (Hybrid)</div>
                                    </td>
                                    <td class="px-6 py-4">20 Nov 2025</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold border border-yellow-200">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button onclick="toggleModal('modal-1')" class="bg-blue-600 text-white hover:bg-blue-700 px-3 py-1.5 rounded text-xs font-medium shadow-sm transition-transform transform hover:scale-105">
                                            Review
                                        </button>
                                    </td>
                                </tr>

                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center text-green-600 mr-3 font-bold">CD</div>
                                            <div>
                                                <div class="font-bold text-gray-800">CV Digital Kreatif</div>
                                                <div class="text-xs text-gray-500">Industri: Agency</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-800">Social Media Admin</div>
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">Full Time</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-gray-800">Rp 4.000.000</div>
                                        <div class="text-xs text-gray-500">Bandung (WFO)</div>
                                    </td>
                                    <td class="px-6 py-4">19 Nov 2025</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold border border-yellow-200">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="bg-blue-600 text-white hover:bg-blue-700 px-3 py-1.5 rounded text-xs font-medium shadow-sm transition-transform transform hover:scale-105">
                                            Review
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                        <span class="text-sm text-gray-500">Menampilkan 1-10 dari 12 data</span>
                        <div class="flex gap-2">
                            <button class="px-3 py-1 border rounded hover:bg-gray-50 text-sm text-gray-600">Previous</button>
                            <button class="px-3 py-1 border rounded bg-blue-600 text-white text-sm">1</button>
                            <button class="px-3 py-1 border rounded hover:bg-gray-50 text-sm text-gray-600">2</button>
                            <button class="px-3 py-1 border rounded hover:bg-gray-50 text-sm text-gray-600">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="modal-1" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
        
        <div class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded-xl shadow-2xl z-50 overflow-y-auto max-h-[90vh] animate-fade-in-up">
            
            <div class="modal-header py-4 px-6 border-b border-gray-100 flex justify-between items-center bg-gray-50 rounded-t-xl">
                <h3 class="font-bold text-lg text-gray-800">Review Lowongan #REQ-2025001</h3>
                <div onclick="toggleModal('modal-1')" class="cursor-pointer z-50 text-gray-500 hover:text-red-500">
                    <i class="fas fa-times text-xl"></i>
                </div>
            </div>

            <div class="modal-content py-6 px-6 text-left">
                
                <div class="flex items-start mb-6">
                    <div class="h-16 w-16 bg-indigo-100 rounded-lg flex items-center justify-center text-indigo-600 text-2xl font-bold mr-4">TM</div>
                    <div>
                        <h4 class="text-xl font-bold text-gray-800">Frontend Developer Intern</h4>
                        <p class="text-blue-600 font-medium">PT Teknologi Maju</p>
                        <div class="flex gap-4 mt-2 text-sm text-gray-500">
                            <span><i class="fas fa-map-marker-alt mr-1"></i> Jakarta Selatan</span>
                            <span><i class="fas fa-money-bill-wave mr-1"></i> Rp 2.5 jt - 3 jt</span>
                            <span><i class="fas fa-clock mr-1"></i> Magang 6 Bulan</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h5 class="font-bold text-gray-700 text-sm uppercase mb-2 border-b pb-1">Deskripsi Pekerjaan</h5>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Kami mencari mahasiswa semester akhir yang bersemangat untuk belajar React.js dan Tailwind CSS. Anda akan bekerja sama dengan tim senior developer untuk mengembangkan fitur dashboard internal perusahaan.
                        </p>
                    </div>
                    <div>
                        <h5 class="font-bold text-gray-700 text-sm uppercase mb-2 border-b pb-1">Kualifikasi</h5>
                        <ul class="list-disc list-inside text-gray-600 text-sm leading-relaxed">
                            <li>Mahasiswa aktif jurusan TI/SI.</li>
                            <li>Memahami dasar HTML, CSS, dan JavaScript.</li>
                            <li>Pernah menggunakan framework React adalah nilai plus.</li>
                            <li>Bersedia WFO 2 hari dalam seminggu.</li>
                        </ul>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Audit (Opsional)</label>
                    <textarea class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none" rows="2" placeholder="Berikan alasan jika ditolak..."></textarea>
                </div>
            </div>

            <div class="modal-footer py-4 px-6 border-t border-gray-100 bg-gray-50 rounded-b-xl flex justify-end gap-3">
                <button onclick="toggleModal('modal-1')" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-600 text-sm hover:bg-gray-100 font-medium">
                    Batal
                </button>
                <button class="px-4 py-2 bg-red-100 border border-red-200 text-red-700 rounded-lg text-sm hover:bg-red-200 font-bold flex items-center">
                    <i class="fas fa-times mr-2"></i> Tolak
                </button>
                <button class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700 font-bold flex items-center shadow-lg">
                    <i class="fas fa-check mr-2"></i> Setujui & Terbitkan
                </button>
            </div>
        </div>
    </div>

    <script>
        // Script Sederhana untuk Buka/Tutup Modal
        function toggleModal(modalID){
            const modal = document.getElementById(modalID);
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
            document.body.classList.toggle('modal-active');
        }

        // Tutup modal jika klik di luar konten (overlay)
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