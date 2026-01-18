<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SetProdi;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Kurikulum;

class SetProdiController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        $prodi    = Prodi::with('fakultas')->orderBy('nama_prodi')->get();

        $active = SetProdi::with(['fakultas','prodi'])
                    ->where('status','Aktif')
                    ->first();

        return view('set-prodi.index', compact(
            'fakultas','prodi','active'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fakultas_id'     => 'required|exists:fakultas,id',
            'prodi_id'        => 'required|exists:prodi,id',
            'tahun_kurikulum' => 'required|digits:4'
        ]);

        // 1️⃣ Nonaktifkan SET PRODI lama
        SetProdi::where('status','Aktif')->update(['status'=>'Nonaktif']);

        // 2️⃣ Simpan SET PRODI baru
        $setProdi = SetProdi::create([
            'fakultas_id'     => $request->fakultas_id,
            'prodi_id'        => $request->prodi_id,
            'tahun_kurikulum' => $request->tahun_kurikulum,
            'status'          => 'Aktif'
        ]);

        // 3️⃣ Nonaktifkan kurikulum lama
        Kurikulum::where('status','aktif')->update(['status'=>'nonaktif']);

        // 4️⃣ BUAT KURIKULUM BARU (INI KUNCI)
        Kurikulum::create([
            'prodi_id' => $request->prodi_id,
            'tahun'    => $request->tahun_kurikulum,
            'status'   => 'aktif'
        ]);

        return redirect()
            ->route('set-prodi.index')
            ->with('success','Prodi & Tahun Kurikulum berhasil diset aktif');
    }
}
