<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Kurikulum;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MataKuliahImport;
use App\Exports\MataKuliahTemplateExport;

class MataKuliahController extends Controller
{
    public function index()
    {
        $kurikulum = Kurikulum::with('prodi.fakultas')
            ->where('status', 'Aktif')
            ->firstOrFail();

        $mk = MataKuliah::all();

        return view('kurikulum.mata_kuliah.index', compact('mk', 'kurikulum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'deskripsi' => 'required',
        ]);

        MataKuliah::create($request->all());

        return back()->with('success', 'Mata Kuliah berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'deskripsi' => 'required',
        ]);

        MataKuliah::findOrFail($id)->update($request->all());

        return back()->with('success', 'Mata Kuliah berhasil diperbarui');
    }

    public function destroy($id)
    {
        MataKuliah::findOrFail($id)->delete();
        return back()->with('success', 'Mata Kuliah berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new MataKuliahImport, $request->file('file'));

        return back()->with('success', 'Mata Kuliah berhasil diimport');
    }

    public function template()
    {
        return Excel::download(
            new MataKuliahTemplateExport,
            'template_mata_kuliah.xlsx'
        );
    }
}
