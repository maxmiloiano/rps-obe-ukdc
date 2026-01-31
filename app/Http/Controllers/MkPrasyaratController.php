<?php

namespace App\Http\Controllers;

use App\Models\PenyusunanMk;
use App\Models\MkPrasyarat;
use Illuminate\Http\Request;
use App\Models\Kurikulum;

class MkPrasyaratController extends Controller
{
    public function index()
    {
         // 🔹 Ambil kurikulum aktif (SAMA seperti Penyusunan MK)
        $kurikulum = Kurikulum::with('prodi.fakultas')
            ->where('status', 'Aktif')
            ->firstOrFail();

        // Ambil MK yang SUDAH disusun
        $data = PenyusunanMk::with(['mataKuliah.prasyarat.prasyarat.penyusunan'])
            ->whereNotNull('semester')   // hanya MK yg sudah disusun
            ->orderBy('semester')
            ->get()
            ->groupBy('semester');
        // semua MK (untuk dropdown prasyarat)
        $allMk = PenyusunanMk::with('mataKuliah')
            ->orderBy('semester')
            ->get();    

        return view('kurikulum.penyusunan.mk_prasyarat', compact(
            'kurikulum',
            'data',
            'allMk'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
        'mk_id' => 'required',
        'prasyarat_id' => 'required|different:mk_id'
        ]);
        MkPrasyarat::updateOrCreate(
            [
                'mk_id'        => $request->mk_id,
                'prasyarat_id' => $request->prasyarat_id
            ]
        );
        return back()->with('success','MK Prasyarat berhasil ditambahkan');
    }
    public function destroy($id)
    {
        MkPrasyarat::findOrFail($id)->delete();
        return back()->with('success', 'MK Prasyarat berhasil dihapus');
    }
}
