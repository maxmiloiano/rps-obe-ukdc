<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilLulusan;
use App\Models\Kurikulum;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProfilLulusanImport;
use App\Exports\ProfilLulusanTemplateExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProfilLulusanController extends Controller
{
    public function index()
    {
        $kurikulum = Kurikulum::with('prodi.fakultas')
            ->where('status','Aktif')
            ->first();

        if (!$kurikulum) {
            return redirect()->route('set-prodi.index')
                ->with('error','Silakan set Prodi & Tahun Aktif terlebih dahulu');
        }

        $pl = ProfilLulusan::where('kurikulum_id',$kurikulum->id)->get();

        return view('kurikulum.pl.index', compact('pl','kurikulum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pl'   => 'required',
            'deskripsi' => 'required'
        ]);

        $kurikulum = Kurikulum::where('status','Aktif')->firstOrFail();

        ProfilLulusan::create([
            'kode_pl'      => $request->kode_pl,
            'deskripsi'    => $request->deskripsi,
            'kurikulum_id' => $kurikulum->id
        ]);

        return redirect()->back()
            ->with('success','Profil Lulusan berhasil ditambahkan');
    }
    // ================= EDIT =================
    public function edit($id)
    {
        $pl = ProfilLulusan::findOrFail($id);
        return view('kurikulum.pl.edit', compact('pl'));
    }
    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_pl'   => 'required',
            'deskripsi' => 'required'
        ]);

        $pl = ProfilLulusan::findOrFail($id);
        $pl->update($request->all());

        return redirect()->route('kurikulum.pl.index')
            ->with('success','Profil Lulusan berhasil diperbarui');
    }
    public function destroy($id)
    {
        $pl = ProfilLulusan::findOrFail($id);
        $pl->delete();

    return redirect()->back()
        ->with('success','Profil Lulusan berhasil dihapus');
    }
    // ================= IMPORT =================
    public function import(Request $request)
    {
        $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

        $kurikulum = Kurikulum::where('status', 'Aktif')->firstOrFail();

        Excel::import(
        new ProfilLulusanImport($kurikulum->id),
        $request->file('file')
    );

    return redirect()->back()
        ->with('success', 'Profil Lulusan berhasil diimport');
    }
    // ================= Download Template =================
    public function downloadTemplate()
    {
            $kurikulum = Kurikulum::where('status', 'Aktif')->firstOrFail();
        return Excel::download(
        new ProfilLulusanTemplateExport($kurikulum->id),
        'template_profil_lulusan.xlsx'
        );
    }
}


