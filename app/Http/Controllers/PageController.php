<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pelatihan;
use App\Models\Loker;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Mitra;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function home()
    {
        return view('page.home');
    }

        public function dashboard()
    {
        $user = auth()->user();
        $mitra = auth()->user()->mitra;

        // When jago ya
        if ($user->role == 1) { // admin
            // Statistics
            $totalUsers = User::count();
            $totalMahasiswa = Mahasiswa::count();
            $totalMitra = Mitra::count();
            $totalLoker = Loker::count();
            $lokerAktif = Loker::where('status', 'approved')->count();
            $lokerPending = Loker::where('status', 'pending')->count();
            $totalPelatihan = Pelatihan::count();
            $pelatihanPending = Pelatihan::where('status', 'pending')->count();

            // Get total lamaran (applications)
            $totalLamaran = \DB::table('loker_mahasiswa')->count();

            // Recent activities - get latest users
            $recentUsers = User::with(['mahasiswa', 'mitra'])
                ->latest()
                ->take(5)
                ->get();

            // Recent lokers
            $recentLokers = Loker::with('mitra')
                ->latest()
                ->take(5)
                ->get();

            return view('page.admin.dashboard', compact(
                'totalUsers',
                'totalMahasiswa',
                'totalMitra',
                'totalLoker',
                'lokerAktif',
                'lokerPending',
                'totalPelatihan',
                'pelatihanPending',
                'totalLamaran',
                'recentUsers',
                'recentLokers'
            ));
        }

        if ($user->role == 2) { // mitra
            $loker_count = $mitra->loker()->count();

            // Get loker IDs for this mitra
            $lokerIds = $mitra->loker()->pluck('id');

            // Total pelamar untuk semua loker mitra ini
            $totalPelamar = \DB::table('loker_mahasiswa')
                ->whereIn('loker_id', $lokerIds)
                ->count();

            // Pesan/notifikasi belum dibaca
            $unreadNotifications = \App\Models\Notification::where('user_id', $user->id)
                ->unread()
                ->count();

            // Pelamar baru minggu ini
            $pelamarMingguIni = \DB::table('loker_mahasiswa')
                ->whereIn('loker_id', $lokerIds)
                ->where('created_at', '>=', now()->startOfWeek())
                ->count();

            // Pelamar terbaru (5 terakhir)
            $pelamarTerbaru = \DB::table('loker_mahasiswa')
                ->join('mahasiswas', 'loker_mahasiswa.mahasiswa_id', '=', 'mahasiswas.id')
                ->join('lokers', 'loker_mahasiswa.loker_id', '=', 'lokers.id')
                ->whereIn('loker_mahasiswa.loker_id', $lokerIds)
                ->select(
                    'mahasiswas.id as mahasiswa_id',
                    'mahasiswas.nama as nama_mahasiswa',
                    'lokers.title as posisi',
                    'loker_mahasiswa.created_at as tanggal_melamar',
                    'loker_mahasiswa.status'
                )
                ->orderBy('loker_mahasiswa.created_at', 'desc')
                ->take(5)
                ->get();

            return view('page.mitra.dashboard', compact(
                'mitra',
                'loker_count',
                'totalPelamar',
                'unreadNotifications',
                'pelamarMingguIni',
                'pelamarTerbaru'
            ));
        }

        abort(403, 'Kamu ngapain di sini?');
    }

    public function notif()
    {
        return view('page.notif');
    }


}
