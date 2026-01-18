<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cpl;
use App\Models\Kurikulum;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CplImport;
use App\Exports\CplTemplateExport;

class CplController extends Controller
{
    public function index()
    {
        $kurikulum = Kurikulum::with('prodi.fakultas')
            ->where('status', 'Aktif')
            ->firstOrFail();

        $cpl = Cpl::where('kurikulum_id', $kurikulum->id)->get();

        return view('kurikulum.cpl.index', compact('cpl', 'kurikulum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_cpl'  => 'required',
            'deskripsi' => 'required'
        ]);

        $kurikulum = Kurikulum::where('status', 'Aktif')->firstOrFail();

        Cpl::create([
            'kode_cpl'     => $request->kode_cpl,
            'deskripsi'    => $request->deskripsi,
            'kurikulum_id' => $kurikulum->id
        ]);

        return back()->with('success', 'CPL berhasil ditambahkan');
    }

    public function edit($id)
    {
        $cpl = Cpl::findOrFail($id);
        return view('kurikulum.cpl.edit', compact('cpl'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_cpl'  => 'required',
            'deskripsi' => 'required'
        ]);

        $cpl = Cpl::findOrFail($id);
        $cpl->update($request->all());

        return redirect()->route('kurikulum.cpl.index')
            ->with('success', 'CPL berhasil diperbarui');
    }

    public function destroy($id)
    {
        Cpl::findOrFail($id)->delete();
        return back()->with('success', 'CPL berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $kurikulum = Kurikulum::where('status', 'Aktif')->firstOrFail();

        Excel::import(
            new CplImport($kurikulum->id),
            $request->file('file')
        );

        return back()->with('success', 'CPL berhasil diimport');
    }

    public function downloadTemplate()
    {
        $kurikulum = Kurikulum::where('status', 'Aktif')->firstOrFail();

        return Excel::download(
            new CplTemplateExport($kurikulum->id),
            'template_cpl.xlsx'
        );
    }
}
