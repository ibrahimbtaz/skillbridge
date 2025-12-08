<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        return view('page.mahasiswa.profile', compact('mahasiswa'));
    }

    /**
     * Display mahasiswa profile for public view (by Mitra)
     */
    public function showPublic(Mahasiswa $mahasiswa)
    {
        // Load relasi user jika diperlukan
        $mahasiswa->load('user');
        return view('page.mahasiswa.profile', compact('mahasiswa'));
    }

    public function status_loker()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $lamaran = $mahasiswa->lamaran()
                    ->with(['mitra'])
                    ->orderBy('loker_mahasiswa.created_at', 'desc')
                    ->get();

        return view('page.mahasiswa.status_loker', compact('lamaran'));
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
        $mahasiswa = auth()->user()->mahasiswa;
        return view('page.mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'nullable|string|max:1000',

            // Education fields (array)
            'edu_institution.*' => 'nullable|string|max:255',
            'edu_degree.*' => 'nullable|string|max:255',
            'edu_years.*' => 'nullable|string|max:50',

            // Experience fields (array)
            'exp_title.*' => 'nullable|string|max:255',
            'exp_company.*' => 'nullable|string|max:255',
            'exp_dates.*' => 'nullable|string|max:50',

            // Skills (array)
            'skills.*' => 'nullable|string|max:100',

            // Additional contact
            'github' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'portfolio' => 'nullable|string|max:255',

            // Languages
            'bahasa_nama.*' => 'nullable|string|max:100',
            'bahasa_level.*' => 'nullable|string|max:50',
        ]);

        $mahasiswa = auth()->user()->mahasiswa;

        // Handle foto profil upload
        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($mahasiswa->foto_profil && \Storage::disk('public')->exists($mahasiswa->foto_profil)) {
                \Storage::disk('public')->delete($mahasiswa->foto_profil);
            }

            // Simpan foto baru
            $path = $request->file('foto_profil')->store('profile/mahasiswa', 'public');
            $mahasiswa->foto_profil = $path;
        }

        // Update basic info
        $mahasiswa->nama = $validated['nama'];
        $mahasiswa->bio = $validated['bio'] ?? null;

        // Update email di tabel users juga
        $mahasiswa->user->update([
            'email' => $validated['email'],
            'name' => $validated['nama'],
        ]);

        // Build pendidikan array
        $pendidikan = [];
        if ($request->has('edu_institution')) {
            foreach ($request->edu_institution as $index => $institution) {
                if (!empty($institution)) {
                    $pendidikan[] = [
                        'institution' => $institution,
                        'degree' => $request->edu_degree[$index] ?? '',
                        'years' => $request->edu_years[$index] ?? '',
                    ];
                }
            }
        }
        $mahasiswa->pendidikan = !empty($pendidikan) ? $pendidikan : null;

        // Build pengalaman array
        $pengalaman = [];
        if ($request->has('exp_title')) {
            foreach ($request->exp_title as $index => $title) {
                if (!empty($title)) {
                    $pengalaman[] = [
                        'title' => $title,
                        'company' => $request->exp_company[$index] ?? '',
                        'dates' => $request->exp_dates[$index] ?? '',
                    ];
                }
            }
        }
        $mahasiswa->pengalaman = !empty($pengalaman) ? $pengalaman : null;

        // Build skills array
        $skills = [];
        if ($request->has('skills')) {
            foreach ($request->skills as $skill) {
                if (!empty($skill)) {
                    $skills[] = $skill;
                }
            }
        }
        $mahasiswa->skills = !empty($skills) ? $skills : null;

        // Build kontak tambahan
        $kontak_tambahan = [];
        if (!empty($request->github)) {
            $kontak_tambahan['github'] = $request->github;
        }
        if (!empty($request->linkedin)) {
            $kontak_tambahan['linkedin'] = $request->linkedin;
        }
        if (!empty($request->portfolio)) {
            $kontak_tambahan['portfolio'] = $request->portfolio;
        }
        $mahasiswa->kontak_tambahan = !empty($kontak_tambahan) ? $kontak_tambahan : null;

        // Build bahasa array
        $bahasa = [];
        if ($request->has('bahasa_nama')) {
            foreach ($request->bahasa_nama as $index => $nama) {
                if (!empty($nama)) {
                    $bahasa[] = [
                        'nama' => $nama,
                        'level' => $request->bahasa_level[$index] ?? '',
                    ];
                }
            }
        }
        $mahasiswa->bahasa = !empty($bahasa) ? $bahasa : null;

        $mahasiswa->save();

        return redirect()->route('mahasiswa.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Generate and download CV as PDF
     */
    public function downloadCV()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $mahasiswa->load('user');

        $pdf = Pdf::loadView('page.mahasiswa.cv-pdf', compact('mahasiswa'));
        $pdf->setPaper('a4', 'portrait');

        $filename = 'CV_' . str_replace(' ', '_', $mahasiswa->nama) . '_' . date('Ymd') . '.pdf';

        return $pdf->download($filename);
    }
}
