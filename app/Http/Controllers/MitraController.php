<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return(view('mitra.index'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id = null)
    {
        // PROFIL PRIBADI (mitra login)
        if ($id === null) {
            $mitra = auth()->user()->mitra;
            return view('page.mitra.profile', compact('mitra'));
        }

        // PROFIL PUBLIK
        $mitra = Mitra::findOrFail($id);
        $loker = request()->query('loker'); // id loker asal

        return view('page.mitra.profile', compact('mitra', 'loker'));
    }

    public function kelola()
    {
        $mitra = auth()->user()->mitra;
        $lokers = $mitra->loker()->get();
        return view('page.mitra.loker.kelola', compact('lokers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mitra $mitra)
    {
        $mitra = auth()->user()->mitra;
        return view('page.mitra.edit', compact('mitra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mitra $mitra)
    {
        $mitra = auth()->user()->mitra;

        $validated = $request->validate([
            'nama_mitra' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            'industri' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'telepon' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
        ]);

        if ($request->hasFile('logo')) {
            if ($mitra->logo && \Storage::disk('public')->exists($mitra->logo)) {
                \Storage::disk('public')->delete($mitra->logo);
            }
            $path = $request->file('logo')->store('profile/mitra', 'public');
            $mitra->logo = $path;
        }

        $mitra->nama_mitra = $validated['nama_mitra'];
        $mitra->email = $validated['email'];
        $mitra->deskripsi = $validated['deskripsi'] ?? null;
        $mitra->industri = $validated['industri'] ?? null;
        $mitra->website = $validated['website'] ?? null;
        $mitra->telepon = $validated['telepon'] ?? null;
        $mitra->alamat = $validated['alamat'] ?? null;
        $mitra->kota = $validated['kota'] ?? null;
        $mitra->provinsi = $validated['provinsi'] ?? null;

        $mitra->save();

        return redirect()->route('mitra.show')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mitra $mitra)
    {
        //
    }
}
