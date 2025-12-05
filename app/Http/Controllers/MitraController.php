<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Loker;
use App\Models\Mahasiswa;
use App\Models\Notification;
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
        $lokers = $mitra->loker()->with('pelamar')->get();
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

    /**
     * Daftar pelamar untuk semua loker mitra
     */
    public function pelamar(Request $request)
    {
        $mitra = auth()->user()->mitra;

        // Ambil semua loker milik mitra dengan pelamar
        $query = Loker::where('mitra_id', $mitra->id)
                      ->withCount('pelamar')
                      ->with(['pelamar' => function($q) use ($request) {
                          // Filter by status jika ada
                          if ($request->status) {
                              $q->wherePivot('status', $request->status);
                          }
                          $q->orderBy('loker_mahasiswa.created_at', 'desc');
                      }]);

        // Filter by loker tertentu
        if ($request->loker_id) {
            $query->where('id', $request->loker_id);
        }

        $lokers = $query->get();

        // Hitung statistik
        $totalPelamar = 0;
        $statusCount = [
            'pending' => 0,
            'reviewed' => 0,
            'interview' => 0,
            'accepted' => 0,
            'rejected' => 0,
        ];

        foreach ($lokers as $loker) {
            foreach ($loker->pelamar as $pelamar) {
                $totalPelamar++;
                $statusCount[$pelamar->pivot->status]++;
            }
        }

        // List semua loker untuk dropdown filter
        $allLokers = Loker::where('mitra_id', $mitra->id)->get();

        return view('page.mitra.pelamar.index', compact('lokers', 'allLokers', 'totalPelamar', 'statusCount'));
    }

    /**
     * Detail pelamar untuk loker tertentu
     */
    public function detailPelamar(Loker $loker)
    {
        $mitra = auth()->user()->mitra;

        // Pastikan loker milik mitra ini
        if ($loker->mitra_id !== $mitra->id) {
            abort(403, 'Anda tidak memiliki akses ke loker ini.');
        }

        $loker->load(['pelamar.user', 'pelamar' => function($q) {
            $q->orderBy('loker_mahasiswa.created_at', 'desc');
        }]);

        return view('page.mitra.pelamar.detail', compact('loker'));
    }

    /**
     * Update status lamaran
     */
    public function updateStatusLamaran(Request $request, Loker $loker, $mahasiswaId)
    {
        $mitra = auth()->user()->mitra;

        // Pastikan loker milik mitra ini
        if ($loker->mitra_id !== $mitra->id) {
            abort(403, 'Anda tidak memiliki akses ke loker ini.');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,interview,accepted,rejected',
            'catatan_mitra' => 'nullable|string|max:1000',
        ]);

        // Ambil status lama untuk perbandingan
        $currentStatus = $loker->pelamar()->where('mahasiswa_id', $mahasiswaId)->first()?->pivot?->status;

        // Update status di pivot table
        $loker->pelamar()->updateExistingPivot($mahasiswaId, [
            'status' => $validated['status'],
            'catatan_mitra' => $validated['catatan_mitra'] ?? null,
        ]);

        // Kirim notification ke Mahasiswa jika status berubah
        if ($currentStatus !== $validated['status']) {
            $mahasiswa = Mahasiswa::find($mahasiswaId);
            if ($mahasiswa && $mahasiswa->user_id) {
                Notification::createStatusLamaran(
                    $mahasiswa->user_id,
                    $loker,
                    $validated['status'],
                    $mitra->nama_mitra
                );
            }
        }

        return back()->with('success', 'Status lamaran berhasil diperbarui.');
    }
}
