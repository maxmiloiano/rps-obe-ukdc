<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Menampilkan halaman register
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Proses register user baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|email|unique:pengguna,email',
            'password'     => 'required|min:6',
            'role'         => 'required|in:admin,kaprodi,dosen',
            'status'       => 'required|in:Aktif,Nonaktif',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'role'         => $request->role,
            'status'       => $request->status,
        ]);

        return redirect('/login')
            ->with('success', 'Akun berhasil terdaftar. Silakan login.');
    }

    /**
     * Proses login
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            if (Auth::user()->status !== 'Aktif') {
                Auth::logout();
                return redirect('/login')
                    ->with('error', 'Akun Anda tidak aktif.');
            }

            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
