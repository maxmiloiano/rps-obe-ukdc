<?php

namespace App\Http\Controllers;

use App\Models\IndikatorMk;
use App\Models\IndikatorCpl;
use App\Models\MataKuliah;
use App\Models\Kurikulum;
use Illuminate\Http\Request;

class IndikatorMkController extends Controller
{
    /**
     * HALAMAN INDIKATOR MK
     */
    public function index()
{
    // Kurikulum aktif
    $kurikulum = Kurikulum::with('prodi.fakultas')
        ->where('status', 'Aktif')
        ->firstOrFail();

    // CPL + Indikator CPL + MK
    $cpl = \App\Models\Cpl::with([
            'indikator.indikatorMk.mataKuliah'
        ])
        ->where('kurikulum_id', $kurikulum->id)
        ->get();

    // Semua MK (dropdown)
    $allMk = \App\Models\MataKuliah::orderBy('kode_mk')->get();

    return view(
        'kurikulum.penyusunan.indikator_mk',
        compact('kurikulum', 'cpl', 'allMk')
    );
}

    /**
     * TAMBAH MK KE INDIKATOR CPL
     */
    public function store(Request $request)
    {
        $request->validate([
            'indikator_cpl_id' => 'required',
            'mk_id'            => 'required'
        ]);

        IndikatorMk::updateOrCreate([
            'indikator_cpl_id' => $request->indikator_cpl_id,
            'mk_id'            => $request->mk_id
        ]);

        return back()->with('success', 'Mata kuliah berhasil ditambahkan');
    }

    /**
     * HAPUS MK DARI INDIKATOR CPL
     */
    public function destroy($id)
    {
        IndikatorMk::findOrFail($id)->delete();

        return back()->with('success', 'Mata kuliah berhasil dihapus');
    }
}
