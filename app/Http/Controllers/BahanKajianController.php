<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanKajian;
use App\Models\Kurikulum;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BahanKajianImport;
use App\Exports\BahanKajianTemplateExport;

class BahanKajianController extends Controller
{
    public function index()
    {
        $kurikulum = Kurikulum::with('prodi.fakultas')
            ->where('status', 'Aktif')
            ->firstOrFail();

        $bk = BahanKajian::where('kurikulum_id', $kurikulum->id)->get();

        return view('kurikulum.bahan_kajian.index', compact('bk', 'kurikulum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_bahan_kajian' => 'required',
            'nama_bahan_kajian' => 'required',
            'deskripsi'         => 'required',
        ]);

        $kurikulum = Kurikulum::where('status', 'Aktif')->firstOrFail();

        BahanKajian::create([
            'kode_bahan_kajian' => $request->kode_bahan_kajian,
            'nama_bahan_kajian' => $request->nama_bahan_kajian,
            'deskripsi'         => $request->deskripsi,
            'kurikulum_id'      => $kurikulum->id,
        ]);

        return back()->with('success', 'Bahan Kajian berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_bahan_kajian' => 'required',
            'nama_bahan_kajian' => 'required',
            'deskripsi'         => 'required',
        ]);

        BahanKajian::findOrFail($id)->update($request->all());

        return back()->with('success', 'Bahan Kajian berhasil diperbarui');
    }

    public function destroy($id)
    {
        BahanKajian::findOrFail($id)->delete();
        return back()->with('success', 'Bahan Kajian berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $kurikulum = Kurikulum::where('status', 'Aktif')->firstOrFail();

        Excel::import(
            new BahanKajianImport($kurikulum->id),
            $request->file('file')
        );

        return back()->with('success', 'Bahan Kajian berhasil diimport');
    }

    public function template()
    {
        $kurikulum = Kurikulum::where('status', 'Aktif')->firstOrFail();

        return Excel::download(
            new BahanKajianTemplateExport($kurikulum->id),
            'template_bahan_kajian.xlsx'
        );
    }
}
