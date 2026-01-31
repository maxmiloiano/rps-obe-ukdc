<?php

namespace App\Http\Controllers;

use App\Models\PenyusunanMk;
use App\Models\MkDosen;
use App\Models\Dosen;
use App\Models\Kurikulum;
use Illuminate\Http\Request;

class MkDosenController extends Controller
{
    public function index()
    {
        $kurikulum = Kurikulum::with('prodi.fakultas')
            ->where('status','Aktif')
            ->firstOrFail();

        // Sama seperti MK Prasyarat
        $data = PenyusunanMk::with([
                'mataKuliah',
                'mataKuliah.mkDosen.dosen'
            ])
            ->whereNotNull('semester')
            ->orderBy('semester')
            ->get()
            ->groupBy('semester');

        $allDosen = Dosen::orderBy('nama_dosen')->get();

        return view('kurikulum.penyusunan.mk_dosen', compact(
            'kurikulum',
            'data',
            'allDosen'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mk_id'    => 'required',
            'dosen_id' => 'required'
        ]);

        MkDosen::updateOrCreate([
            'mk_id'    => $request->mk_id,
            'dosen_id' => $request->dosen_id
        ]);

        return back()->with('success','Dosen Pengampu berhasil ditambahkan');
    }

    public function destroy($id)
    {
        MkDosen::findOrFail($id)->delete();
        return back()->with('success','Dosen Pengampu berhasil dihapus');
    }
}
