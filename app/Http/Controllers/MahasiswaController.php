<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.mahasiswa.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|unique:mahasiswas,nim',
            'jurusan' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_telp' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        return view('page.mahasiswa.profile', compact('mahasiswa'));
    }

    public function status_loker()
    {
        return view('page.mahasiswa.status_loker');
    }

    public function portofolio()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        return view('page.mahasiswa.portofolio', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('page.mahasiswa.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
