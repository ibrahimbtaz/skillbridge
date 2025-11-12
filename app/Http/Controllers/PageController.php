<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


        if ($user->role == 1) { // admin
            return view('page.admin.dashboard');
        }

        if ($user->role == 2) { // mitra
            $loker_count = $mitra->loker()->count();
            return view('page.mitra.dashboard', compact('mitra', 'loker_count'));
        }

        abort(403, 'Kamu ngapain di sini?');
    }

    public function mahasiwa_profile()
    {
        return view('page.mahasiswa.profile');
    }
    public function mahasiwa_edit()
    {
        return view('page.mahasiswa.edit');
    }
    public function mahasiswa_status_loker()
    {
        return view('page.mahasiswa.status_loker');
    }
    public function pelatihan_list()
    {
        return view('page.pelatihan.list');
    }
    public function mitra_loker_list()
    {
        return view('mitra.loker.list');
    }
    public function rating_pelatihan()
    {
        return view('rating_pelatihan');
    }

}
