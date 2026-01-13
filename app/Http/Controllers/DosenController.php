<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\User;

class DosenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nip_nik'     => 'required|unique:dosen,nip_nik',
            'nama_dosen'  => 'required',
            'nidn'        => 'required',
            'email'       => 'required|exists:pengguna,email',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id'    => 'required|exists:prodi,id',
        ]);

        Dosen::create([
        'nip_nik'     => $request->nip_nik,
        'nama_dosen'  => $request->nama_dosen,
        'nidn'        => $request->nidn,
        'email'       => $request->email,
        'fakultas_id' => $request->fakultas_id,
        'prodi_id'    => $request->prodi_id,
    ]);

        return redirect()
            ->route('data-master.index',['tab'=>'dosen'])
            ->with('success','Data dosen berhasil ditambahkan');
    }
    public function edit($id)
    {
        return view('data-master.edit-dosen', [
            'dosen'    => Dosen::findOrFail($id),
            'fakultas' => Fakultas::all(),
            'prodi'    => Prodi::all(),
            'users'    => User::all(),
        ]);
    }
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nip_nik'     => 'required|unique:dosen,nip_nik,' . $id,
            'nidn'        => 'required|unique:dosen,nidn,' . $id,
            'nama_dosen'  => 'required',
            'email'       => 'required|email',
            'fakultas_id' => 'required',
            'prodi_id'    => 'required',
        ]);

        $dosen->update([
        'nip_nik' => $request->nip_nik,
        'nidn' => $request->nidn,
        'nama_dosen' => $request->nama_dosen,
        'email' => $request->email,
        'fakultas_id' => $request->fakultas_id,
        'prodi_id' => $request->prodi_id,
    ]);

        return redirect()
            ->route('data-master.index', ['tab' => 'dosen'])
            ->with('success', 'Data dosen berhasil diperbarui');
    }

    public function destroy($id)
    {
        Dosen::findOrFail($id)->delete();

        return redirect()
            ->route('data-master.index',['tab'=>'dosen'])
            ->with('success','Data dosen berhasil dihapus');
    }
}
