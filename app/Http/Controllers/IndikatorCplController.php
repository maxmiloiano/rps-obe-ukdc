<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cpl;
use App\Models\IndikatorCpl;
use App\Models\Kurikulum;

class IndikatorCplController extends Controller
{
    public function index()
    {
        $kurikulum = Kurikulum::with('prodi.fakultas')
            ->where('status', 'Aktif')
            ->firstOrFail();

        $cpl = Cpl::with('indikator')
            ->where('kurikulum_id', $kurikulum->id)
            ->get();

        return view('kurikulum.indikator.index', compact('kurikulum', 'cpl'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cpl_id'         => 'required',
            'kode_indikator' => 'required',
            'deskripsi'      => 'required',
            'bobot'          => 'required|integer|min:1|max:100'
        ]);

        IndikatorCpl::create($request->all());

        return back()->with('success', 'Indikator CPL berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_indikator' => 'required',
            'deskripsi'      => 'required',
            'bobot'          => 'required|integer|min:1|max:100'
        ]);

        $indikator = IndikatorCpl::findOrFail($id);
        $indikator->update($request->all());

        return back()->with('success', 'Indikator berhasil diperbarui');
    }


    public function destroy($id)
    {
        IndikatorCpl::findOrFail($id)->delete();
        return back()->with('success', 'Indikator CPL berhasil dihapus');
    }
}
