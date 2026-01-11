<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Tampilkan daftar pengguna
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Form edit pengguna
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update data pengguna
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'role' => 'required|in:admin,kaprodi,dosen',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Data pengguna berhasil diperbarui');
    }

    /**
     * Hapus pengguna
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'Data pengguna berhasil dihapus');
    }
}
