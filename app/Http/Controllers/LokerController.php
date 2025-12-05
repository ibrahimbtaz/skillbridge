<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\Mitra;
use App\Models\Notification;
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'jenis_kerja' => 'required',
            'tipe_kerja' => 'required',
            'salary_min' => 'required|integer|min:0',
            'salary_max' => 'required|integer|min:0|gte:salary_min',
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'nullable|string',
            'requirements' => 'nullable|array',
            'requirements.*' => 'nullable|string',
            'benefits' => 'nullable|array',
            'benefits.*' => 'nullable|string',
            'deadline_date' => 'required|date|after:today',
        ]);

        // Filter array kosong
        $responsibilities = array_filter($validated['responsibilities'] ?? [], fn($item) => !empty(trim($item)));
        $requirements = array_filter($validated['requirements'] ?? [], fn($item) => !empty(trim($item)));
        $benefits = array_filter($validated['benefits'] ?? [], fn($item) => !empty(trim($item)));

        // Ambil mitra_id dari user yang sedang login
        $mitra = auth()->user()->mitra; // Asumsi relasi sudah dibuat

        Loker::create([
            'title' => $validated['title'],
            'deskripsi' => $validated['description'],
            'lokasi' => $validated['location'],
            'jenis_kerja' => $validated['jenis_kerja'],
            'tipe_kerja' => $validated['tipe_kerja'],
            'gaji_min' => $validated['salary_min'],
            'gaji_max' => $validated['salary_max'],
            'tanggung_jawab' => $responsibilities ?: null,
            'kualifikasi' => $requirements ?: null,
            'benefits' => $benefits ?: null,
            'deadline' => $validated['deadline_date'],
            'status' => 'draft', // Default status
            'mitra_id' => $mitra->id,
        ]);

        return redirect()->route('mitra.loker.kelola')
            ->with('success', 'Lowongan berhasil ditambahkan');
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

    /**
     * Apply for a job (Mahasiswa only)
     */
    public function apply(Request $request, Loker $loker)
    {
        // Pastikan user adalah mahasiswa
        if (!auth()->check() || !auth()->user()->mahasiswa) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai mahasiswa untuk melamar.');
        }

        $mahasiswa = auth()->user()->mahasiswa;

        // Cek apakah sudah pernah melamar
        if ($loker->hasApplied($mahasiswa->id)) {
            return back()->with('error', 'Anda sudah melamar pada lowongan ini.');
        }

        // Cek apakah deadline sudah lewat
        if ($loker->deadline && $loker->deadline < now()) {
            return back()->with('error', 'Maaf, deadline lamaran sudah berakhir.');
        }

        // Validasi catatan (opsional)
        $validated = $request->validate([
            'catatan' => 'nullable|string|max:1000',
        ]);

        // Simpan lamaran
        $loker->pelamar()->attach($mahasiswa->id, [
            'status' => 'pending',
            'catatan' => $validated['catatan'] ?? null,
        ]);

        // Kirim notification ke Mitra
        $mitra = $loker->mitra;
        if ($mitra && $mitra->user_id) {
            Notification::createLamaranBaru($mitra->user_id, $mahasiswa, $loker);
        }

        return redirect()->route('mahasiswa.status_loker')->with('success', 'Lamaran berhasil dikirim!');
    }

    /**
     * Cancel application (Mahasiswa only)
     */
    public function cancelApply(Loker $loker)
    {
        // Pastikan user adalah mahasiswa
        if (!auth()->check() || !auth()->user()->mahasiswa) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai mahasiswa.');
        }

        $mahasiswa = auth()->user()->mahasiswa;

        // Cek apakah sudah melamar
        if (!$loker->hasApplied($mahasiswa->id)) {
            return back()->with('error', 'Anda belum melamar pada lowongan ini.');
        }

        // Cek status lamaran - hanya bisa dibatalkan jika masih pending
        $lamaran = $mahasiswa->lamaran()->where('loker_id', $loker->id)->first();
        if ($lamaran && $lamaran->pivot->status !== 'pending') {
            return back()->with('error', 'Lamaran tidak dapat dibatalkan karena sudah diproses.');
        }

        // Hapus lamaran
        $loker->pelamar()->detach($mahasiswa->id);

        return back()->with('success', 'Lamaran berhasil dibatalkan.');
    }
}
