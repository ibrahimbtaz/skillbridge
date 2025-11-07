<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.signin');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials) && Auth::user()->role == "admin") {
            return redirect('/admin')->with('success', 'Berhasil Login');
        } elseif (Auth::attempt($credentials) && Auth::user()->role == "mitra") {
            return redirect('/mitra/dashboard')->with('success', 'Berhasil Login');
        } elseif (Auth::attempt($credentials) && Auth::user()->role == "kampus") {
            return redirect('/kampus/dashboard')->with('success', 'Berhasil Login');
        } elseif (Auth::attempt($credentials) && Auth::user()->role == "user") {
            return redirect(route('beranda'))->with('success', 'Berhasil Login');
        } else {
            return redirect('/')->with('error', 'Login gagal');
        }
    }
}
