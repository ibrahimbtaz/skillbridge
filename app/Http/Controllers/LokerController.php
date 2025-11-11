<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\Mitra;
use Illuminate\Http\Request;


class LokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Loker::with(['mitra.user']);
        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                ->orWhereHas('mitra', function ($m) use ($request) {
                    $m->where('nama_mitra', 'like', '%' . $request->search . '%');
                });
            });
        }
         // lokasi
        if ($request->lokasi) {
            $query->whereHas('mitra', function ($m) use ($request) {
                $m->where('kota', $request->lokasi);
            });
        }
        // JOB TYPE
        if ($request->jenis_kerja) {
            $query->where('jenis_kerja', $request->jenis_kerja);
        }
        if (request('sort') === 'latest') {
            $query->orderBy('created_at', 'desc');
        }
        if (request('sort') === 'salary_high') {
            $query->orderBy('gaji_max', 'desc');
        }
        if (request('sort') === 'salary_low') {
            $query->orderBy('gaji_min', 'asc');
        }
        $lokers = $query->paginate(10)->appends(request()->query());

        $total_loker = Loker::count();
        $total_perusahaan = Loker::distinct('mitra_id')->count('mitra_id');


        // DATA DROPDOWN OTOMATIS SESUAI DB
        $lokasi = Mitra::select('kota')->distinct()->pluck('kota');
        $jenis_kerja = Loker::select('jenis_kerja')->distinct()->pluck('jenis_kerja');

        return view('page.loker.home', compact('lokers', 'lokasi', 'jenis_kerja', 'total_loker', 'total_perusahaan'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.mitra.loker.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'jenis_kerja' => 'required',
            'tipe_kerja' => 'required',
            'gaji_min' => 'required|integer|min:0',
            'gaji_max' => 'required|integer|min:0|gt:gaji_min',
            'tanggung_jawab' => 'required',
            'kualifikasi' => 'required',
            'benefits' => 'required',
            'deadline' => 'required|date|after:today',
        ]);

        $mitra = auth()->user()->mitra;

        $loker = $mitra->loker()->create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'jenis_kerja' => $request->jenis_kerja,
            'tipe_kerja' => $request->tipe_kerja,
            'gaji_min' => $request->gaji_min,
            'gaji_max' => $request->gaji_max,
            'tanggung_jawab' => $request->tanggung_jawab,
            'kualifikasi' => $request->kualifikasi,
            'benefits' => $request->benefits,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('mitra.dashboard')->with('success', 'Loker berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loker $loker, Request $request)
    {
        $loker = Loker::with(['mitra.user'])->findOrFail($loker->id);
        return view('page.loker.show', compact('loker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loker $loker)
    {
        $loker = Loker::with(['mitra.user'])->findOrFail($loker->id);
        return view('page.mitra.loker.edit', compact('loker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loker $loker)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'jenis_kerja' => 'required',
            'tipe_kerja' => 'required',
            'gaji_min' => 'required|integer|min:0',
            'gaji_max' => 'required|integer|min:0|gte:gaji_min',
            'responsibilities' => 'required|array|min:1', // Sesuai nama di form
            'responsibilities.*' => 'required|string',
            'requirements' => 'required|array|min:1', // Sesuai nama di form
            'requirements.*' => 'required|string',
            'benefits' => 'required|array|min:1',
            'benefits.*' => 'required|string',
            'deadline' => 'required|date|after:today',
        ]);

            $loker->update([
            'title' => $validated['title'],
            'deskripsi' => $validated['deskripsi'],
            'lokasi' => $validated['lokasi'],
            'jenis_kerja' => $validated['jenis_kerja'],
            'tipe_kerja' => $validated['tipe_kerja'],
            'gaji_min' => $validated['gaji_min'],
            'gaji_max' => $validated['gaji_max'],
            'tanggung_jawab' => $validated['responsibilities'], // Array otomatis jadi JSON
            'kualifikasi' => $validated['requirements'],
            'benefits' => $validated['benefits'],
            'deadline' => $validated['deadline'],
        ]);



        return redirect()->route('mitra.loker.kelola')->with('success', 'Loker berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loker $loker)
    {

    }
}
