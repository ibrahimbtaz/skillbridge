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
        return (view('auth.mitra.register'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mitra $mitra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mitra $mitra)
    {
        //
    }
}
