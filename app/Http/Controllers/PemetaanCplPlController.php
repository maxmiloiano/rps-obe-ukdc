<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CplPl;

class PemetaanCplPlController extends Controller
{
    /**
     * Simpan relasi CPL - PL
     */
    public function store(Request $request)
    {
        CplPl::firstOrCreate([
            'cpl_id' => $request->cpl_id,
            'pl_id'  => $request->pl_id,
        ]);

        return response()->json(['status' => 'ok']);
    }

    /**
     * Hapus relasi CPL - PL
     */
    public function destroy(Request $request)
    {
        CplPl::where('cpl_id', $request->cpl_id)
             ->where('pl_id', $request->pl_id)
             ->delete();

        return response()->json(['status' => 'deleted']);
    }
}
