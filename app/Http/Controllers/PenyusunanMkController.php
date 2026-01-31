<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\PenyusunanMk;
use App\Models\Kurikulum;

class PenyusunanMkController extends Controller
{
    public function index()
    {
        $kurikulum = Kurikulum::with('prodi.fakultas')
            ->where('status','Aktif')
            ->firstOrFail();

        $mk = MataKuliah::leftJoin('penyusunan_mk', 'mata_kuliah.id', '=', 'penyusunan_mk.mk_id')
            ->select(
                'mata_kuliah.*',
                'penyusunan_mk.sks',
                'penyusunan_mk.kategori',
                'penyusunan_mk.semester'
            )
            ->orderBy('mata_kuliah.kode_mk')
            ->get();

        return view('kurikulum.penyusunan.index', compact(
            'kurikulum','mk'
        ));
    }

    public function store(Request $request)
    {
        foreach ($request->mk as $mkId => $data) {

            if(empty($data['semester']) || empty($data['kategori']) || empty($data['sks'])) {
                continue;
            }

            PenyusunanMk::updateOrCreate(
                ['mk_id' => $mkId],
                [
                    'sks'      => $data['sks'],
                    'kategori' => $data['kategori'],
                    'semester' => $data['semester']
                ]
            );
        }

        return back()->with('success','Penyusunan MK berhasil disimpan');
    }
}
