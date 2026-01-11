<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Fakultas;

class ProdiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi'   => 'required|string|max:100',
            'fakultas_id'  => 'required|exists:fakultas,id',
        ]);

        Prodi::create([
            'nama_prodi'  => $request->nama_prodi,
            'fakultas_id' => $request->fakultas_id,
        ]);

        return redirect()
            ->route('data-master.index',['tab'=>'prodi'])
            ->with('success','Data prodi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        $fakultas = Fakultas::all();

        return view('prodi.edit', compact('prodi','fakultas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_prodi'   => 'required|string|max:100',
            'fakultas_id'  => 'required|exists:fakultas,id',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($request->only('nama_prodi','fakultas_id'));

        return redirect()
            ->route('data-master.index',['tab'=>'prodi'])
            ->with('success','Data prodi berhasil diperbarui');
    }

    public function destroy($id)
    {
        Prodi::findOrFail($id)->delete();

        return redirect()
            ->route('data-master.index',['tab'=>'prodi'])
            ->with('success','Data prodi berhasil dihapus');
    }
}
