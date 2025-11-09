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
    public function show(Loker $loker)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loker $loker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loker $loker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loker $loker)
    {
        //
    }
}
