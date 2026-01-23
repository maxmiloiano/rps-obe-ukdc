<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cpl;
use App\Models\ProfilLulusan;
use App\Models\Kurikulum;
use DB;
use App\Models\CplPl;
use App\Models\BahanKajian;
use App\Models\MataKuliah;


class PemetaanController extends Controller
{
    public function cplPl()
    {
        $kurikulum = Kurikulum::with('prodi.fakultas')
            ->where('status','Aktif')
            ->firstOrFail();

        $cpl = Cpl::with('pls')
            ->where('kurikulum_id', $kurikulum->id)
            ->get();

        $pl = ProfilLulusan::where('kurikulum_id', $kurikulum->id)->get();

        return view('kurikulum.pemetaan.cpl_pl', compact(
            'kurikulum',
            'cpl',
            'pl'
        ));
    }

    public function storeCplPl(Request $request)
    {
        DB::table('cpl_pl')->updateOrInsert([
        'cpl_id' => $request->cpl_id,
        'pl_id'  => $request->pl_id,
        ]);

        return response()->json([
        'status' => 'saved',
        'message' => 'Pilihan tersimpan'
        ]);
    }

        public function destroyCplPl(Request $request)
    {
        DB::table('cpl_pl')
        ->where('cpl_id', $request->cpl_id)
        ->where('pl_id', $request->pl_id)
        ->delete();

        return response()->json([
        'status' => 'deleted',
        'message' => 'Pilihan dibatalkan'
        ]);
    }
    /* ================= CPL & BK ================= */
    public function cplBk()
    {
        $kurikulum = Kurikulum::with('prodi.fakultas')
            ->where('status','Aktif')
            ->firstOrFail();

        $bk = BahanKajian::with('cpls')
            ->where('kurikulum_id', $kurikulum->id)
            ->get();

        $cpl = Cpl::where('kurikulum_id', $kurikulum->id)->get();

        return view('kurikulum.pemetaan.cpl_bk', compact(
            'kurikulum','bk','cpl'
        ));
    }

    public function storeCplBk(Request $request)
    {
        DB::table('cpl_bk')->updateOrInsert([
            'cpl_id' => $request->cpl_id,
            'bk_id'  => $request->bk_id
        ]);

        return response()->json([
            'status'  => 'saved',
            'message' => 'Pilihan tersimpan'
        ]);
    }

    public function destroyCplBk(Request $request)
    {
        DB::table('cpl_bk')
            ->where('cpl_id', $request->cpl_id)
            ->where('bk_id', $request->bk_id)
            ->delete();

        return response()->json([
            'status'  => 'deleted',
            'message' => 'Pilihan dibatalkan'
        ]);
    }
    /* ================= BK & MK ================= */
    public function bkMk()
    {
        $kurikulum = Kurikulum::with('prodi.fakultas')
            ->where('status', 'Aktif')
            ->firstOrFail();

        $mk = MataKuliah::with('bahanKajian')->get();

        $bk = BahanKajian::where('kurikulum_id', $kurikulum->id)->get();

        return view('kurikulum.pemetaan.bk_mk', compact(
            'kurikulum', 'mk', 'bk'
        ));
    }
    public function storeBkMk(Request $request)
    {
        DB::table('bk_mk')->updateOrInsert([
            'bk_id' => $request->bk_id,
            'mk_id' => $request->mk_id
        ]);

        return response()->json([
            'status'  => 'saved',
            'message' => 'Pilihan tersimpan'
        ]);
    }
     public function destroyBkMk(Request $request)
    {
        DB::table('bk_mk')
            ->where('bk_id', $request->bk_id)
            ->where('mk_id', $request->mk_id)
            ->delete();

        return response()->json([
            'status'  => 'deleted',
            'message' => 'Pilihan dibatalkan'
        ]);
    }
    /* ================= CPL & MK ================= */
    public function cplMk()
{
    $kurikulum = Kurikulum::with('prodi.fakultas')
        ->where('status','Aktif')
        ->firstOrFail();

    // AMBIL SEMUA MK (karena tidak ada kurikulum_id)
    $mk = MataKuliah::with('cpls')->get();

    $cpl = Cpl::where('kurikulum_id', $kurikulum->id)->get();

    return view('kurikulum.pemetaan.cpl_mk', compact(
        'kurikulum','mk','cpl'
    ));
}

public function storeCplMk(Request $request)
{
    DB::table('cpl_mk')->updateOrInsert([
        'cpl_id' => $request->cpl_id,
        'mk_id'  => $request->mk_id
    ]);

    return response()->json([
        'status'  => 'saved',
        'message' => 'Pilihan tersimpan'
    ]);
}

public function destroyCplMk(Request $request)
{
    DB::table('cpl_mk')
        ->where('cpl_id', $request->cpl_id)
        ->where('mk_id', $request->mk_id)
        ->delete();

    return response()->json([
        'status'  => 'deleted',
        'message' => 'Pilihan dibatalkan'
    ]);
}
}
