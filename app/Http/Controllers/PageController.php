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
}
