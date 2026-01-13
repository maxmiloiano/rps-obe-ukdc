<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\User;
use App\Models\Kaprodi;

class DataMasterController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'fakultas');

        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        $prodi    = Prodi::with('fakultas')->orderBy('nama_prodi')->get();
        $users    = User::orderBy('email')->get();
        $dosen    = Dosen::with(['prodi','fakultas'])->get();
        $kaprodi  = Kaprodi::with(['prodi','fakultas'])->get();

        // 🔑 GENERATE TAHUN KAPRODI
        $tahunList = range(date('Y') - 5, date('Y') + 1);

        return view('data-master.index', compact(
            'tab',
            'fakultas',
            'prodi',
            'users',
            'dosen',
            'kaprodi',
            'tahunList'
        ));
    }

    /* ================= FAKULTAS ================= */
    public function storeFakultas(Request $request)
    {
        $request->validate([
            'kode_fakultas' => 'required|unique:fakultas',
            'nama_fakultas' => 'required'
        ]);

        Fakultas::create($request->only('kode_fakultas','nama_fakultas'));

        return back()->with('success','Data Fakultas berhasil ditambahkan');
    }

    public function destroyFakultas($id)
    {
        Fakultas::findOrFail($id)->delete();
        return back()->with('success','Data Fakultas berhasil dihapus');
    }
    // ================= EDIT FAKULTAS =================
    public function editFakultas($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('data-master.edit-fakultas', compact('fakultas'));
    }

    public function updateFakultas(Request $request, $id)
    {
        $request->validate([
        'kode_fakultas' => 'required|unique:fakultas,kode_fakultas,' . $id,
        'nama_fakultas' => 'required'
    ]);

        Fakultas::findOrFail($id)->update($request->only(
        'kode_fakultas','nama_fakultas'
    ));

        return redirect()
        ->route('data-master.index',['tab'=>'fakultas'])
        ->with('success','Data Fakultas berhasil diperbarui');
    }
    // ================= EDIT PRODI =================
    public function editProdi($id)
    {
        $prodi = Prodi::findOrFail($id);
        $fakultas = Fakultas::all();

        return view('data-master.edit-prodi', compact('prodi','fakultas'));
    }
    public function updateProdi(Request $request, $id)
    {
        $request->validate([
        'nama_prodi' => 'required',
        'fakultas_id' => 'required|exists:fakultas,id'
    ]);

        Prodi::findOrFail($id)->update([
        'nama_prodi' => $request->nama_prodi,
        'fakultas_id' => $request->fakultas_id
    ]);

        return redirect()
        ->route('data-master.index',['tab'=>'prodi'])
        ->with('success','Data Prodi berhasil diperbarui');
    }



    /* ================= PRODI ================= */
    public function storeProdi(Request $request)
    {
        $request->validate([
            'nama_prodi'  => 'required',
            'fakultas_id' => 'required|exists:fakultas,id'
        ]);

        Prodi::create($request->only('nama_prodi','fakultas_id'));

        return back()->with('success','Data Prodi berhasil ditambahkan');
    }

    public function destroyProdi($id)
    {
        Prodi::findOrFail($id)->delete();
        return back()->with('success','Data Prodi berhasil dihapus');
    }

    /* ================= DOSEN ================= */
    public function storeDosen(Request $request)
    {
        $request->validate([
            'nip_nik'     => 'required',
            'nidn'        => 'required',
            'nama_dosen'  => 'required',
            'email'       => 'required|exists:users,email',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id'    => 'required|exists:prodi,id'
        ]);

        Dosen::create($request->all());

        return redirect()->route('data-master.index',['tab'=>'dosen'])
            ->with('success','Data Dosen berhasil ditambahkan');
    }

    public function destroyDosen($id)
    {
        Dosen::findOrFail($id)->delete();
        return back()->with('success','Data Dosen berhasil dihapus');
    }

    /* ================= KAPRODI ================= */
    public function storeKaprodi(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required|exists:prodi,id',
            'tahun'    => 'required|digits:4',
            'nip'      => 'required'
        ]);

        $prodi = Prodi::findOrFail($request->prodi_id);
        $dosen = Dosen::where('nip_nik',$request->nip)->first();

        Kaprodi::create([
            'fakultas_id'  => $prodi->fakultas_id,
            'prodi_id'     => $prodi->id,
            'tahun'        => $request->tahun,
            'nama_kaprodi' => $dosen->nama_dosen,
            'nip'          => $request->nip
        ]);

        return redirect()->route('data-master.index',['tab'=>'kaprodi'])
            ->with('success','Data Kaprodi berhasil ditambahkan');
    }
    public function editKaprodi($id)
    {
        $kaprodi  = Kaprodi::findOrFail($id);
        $prodi    = Prodi::with('fakultas')->get();
        $dosen    = Dosen::all();
        $tahunList = range(date('Y') - 5, date('Y') + 1);

        return view('data-master.edit-kaprodi', compact(
        'kaprodi','prodi','dosen','tahunList'
    ));
    }
    public function updateKaprodi(Request $request, $id)
    {
        $request->validate([
        'prodi_id' => 'required|exists:prodi,id',
        'tahun'    => 'required|digits:4',
        'nip'      => 'required',
    ]);

        $prodi = Prodi::findOrFail($request->prodi_id);
        $dosen = Dosen::where('nip_nik',$request->nip)->first();

        $kaprodi = Kaprodi::findOrFail($id);
        $kaprodi->update([
        'fakultas_id'  => $prodi->fakultas_id,
        'prodi_id'     => $request->prodi_id,
        'tahun'        => $request->tahun,
        'nama_kaprodi' => $dosen->nama_dosen,
        'nip'          => $request->nip,
    ]);

        return redirect()
        ->route('data-master.index',['tab'=>'kaprodi'])
        ->with('success','Data Kaprodi berhasil diperbarui');
    }
    public function destroyKaprodi($id)
    {
        Kaprodi::findOrFail($id)->delete();

        return redirect()
        ->route('data-master.index',['tab'=>'kaprodi'])
        ->with('success','Data Kaprodi berhasil dihapus');
    }
}
