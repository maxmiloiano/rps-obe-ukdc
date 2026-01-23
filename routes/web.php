<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\SetProdiController;
use App\Http\Controllers\ProfilLulusanController;
use App\Http\Controllers\CplController;
use App\Http\Controllers\IndikatorCplController;
use App\Http\Controllers\BahanKajianController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PemetaanController;
use App\Http\Controllers\PenyusunanMkController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route web aplikasi OBE System
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| AUTH (LOGIN & REGISTER CUSTOM)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/register', [AuthController::class, 'register'])->name('register.custom');
Route::post('/register', [AuthController::class, 'store'])->name('register.store.custom');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| DASHBOARD (SETELAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard.index');
    Route::post('/logout',[AuthController::class,'logout']);    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

/*
/--------------------------------------------------------------------------
/ DATA MASTER
/--------------------------------------------------------------------------
*/    
    Route::get('/data-master', [DataMasterController::class, 'index'])->name('data-master.index');
    Route::post('/data-master/fakultas', [DataMasterController::class, 'storeFakultas'])->name('fakultas.store');
    Route::get('/data-master/fakultas/{id}/edit', [DataMasterController::class, 'editFakultas'])->name('fakultas.edit');
    Route::put('/data-master/fakultas/{id}', [DataMasterController::class, 'updateFakultas'])->name('fakultas.update');
    Route::delete('/data-master/fakultas/{id}', [DataMasterController::class, 'destroyFakultas'])->name('fakultas.destroy');
// ===== PRODI =====
    Route::post('/data-master/prodi', [DataMasterController::class, 'storeProdi'])->name('prodi.store');
    Route::get('/data-master/prodi/{id}/edit', [DataMasterController::class, 'editProdi'])->name('prodi.edit');
    Route::put('/data-master/prodi/{id}', [DataMasterController::class, 'updateProdi'])->name('prodi.update');
    Route::delete('/data-master/prodi/{id}', [DataMasterController::class, 'destroyProdi'])->name('prodi.destroy');
    Route::post('/prodi', [ProdiController::class,'store'])->name('prodi.store');
// ====== DOSEN ======
    Route::post('/dosen/store', [DosenController::class,'store'])->name('dosen.store');   
    Route::delete('/dosen/{id}', [DosenController::class,'destroy'])->name('dosen.destroy');
    Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
// ======= KAPRODI =======
    Route::post('/data-master/kaprodi',[DataMasterController::class,'storeKaprodi'])->name('kaprodi.store');
    Route::get('/kaprodi/{id}/edit', [DataMasterController::class,'editKaprodi'])->name('kaprodi.edit');
    Route::put('/kaprodi/{id}', [DataMasterController::class,'updateKaprodi'])->name('kaprodi.update');
    Route::delete('/kaprodi/{id}', [DataMasterController::class,'destroyKaprodi'])->name('kaprodi.destroy');

/*
/--------------------------------------------------------------------------
/ SET PRODI DAN TAHUN
/--------------------------------------------------------------------------
*/  
Route::middleware(['auth'])->group(function () {
    Route::get('/set-prodi', [SetProdiController::class,'index'])->name('set-prodi.index');
    Route::post('/set-prodi', [SetProdiController::class,'store'])->name('set-prodi.store');
});


/*
/--------------------------------------------------------------------------
/ Kurikulum
/--------------------------------------------------------------------------
*/
// ======== PROFIL LULUSAN ========
Route::middleware(['auth'])->group(function () {
    Route::get('/kurikulum/pl', [ProfilLulusanController::class,'index'])->name('kurikulum.pl.index');
    Route::post('/kurikulum/pl', [ProfilLulusanController::class,'store'])->name('kurikulum.pl.store');
    Route::get('/kurikulum/pl/{id}/edit', [ProfilLulusanController::class,'edit'])->name('kurikulum.pl.edit');
    Route::put('/kurikulum/pl/{id}', [ProfilLulusanController::class,'update'])->name('kurikulum.pl.update');
    Route::delete('/kurikulum/pl/{id}', [ProfilLulusanController::class,'destroy'])->name('kurikulum.pl.destroy');
    Route::post('/kurikulum/pl/import', [ProfilLulusanController::class,'import'])->name('kurikulum.pl.import');
    Route::get('/kurikulum/pl/template', [ProfilLulusanController::class,'downloadTemplate'])->name('kurikulum.pl.template');
});
// ======== CPL ========
Route::middleware(['auth'])->group(function () {
    Route::get('/kurikulum/cpl', [CplController::class,'index'])->name('kurikulum.cpl.index');
    Route::post('/kurikulum/cpl', [CplController::class,'store'])->name('kurikulum.cpl.store');
    Route::get('/kurikulum/cpl/{id}/edit', [CplController::class,'edit'])->name('kurikulum.cpl.edit');
    Route::put('/kurikulum/cpl/{id}', [CplController::class,'update'])->name('kurikulum.cpl.update');
    Route::delete('/kurikulum/cpl/{id}', [CplController::class,'destroy'])->name('kurikulum.cpl.destroy');
    Route::post('/kurikulum/cpl/import', [CplController::class,'import'])->name('kurikulum.cpl.import');
    Route::get('/kurikulum/cpl/template', [CplController::class,'downloadTemplate'])->name('kurikulum.cpl.template');
});    
// ======== INDIKATOR CPL ========
Route::middleware(['auth'])->group(function () {
    Route::get('/kurikulum/indikator-cpl', [IndikatorCplController::class,'index'])->name('kurikulum.indikator.index');
    Route::post('/kurikulum/indikator-cpl', [IndikatorCplController::class,'store'])->name('kurikulum.indikator.store');
    Route::delete('/kurikulum/indikator-cpl/{id}', [IndikatorCplController::class,'destroy'])->name('kurikulum.indikator.destroy');
    Route::put('/kurikulum/indikator-cpl/{id}', [IndikatorCplController::class,'update'])->name('kurikulum.indikator.update');

});
// ======== BAHAN KAJIAN ========
Route::middleware(['auth'])->group(function () {
    Route::get('/kurikulum/bahan-kajian', [BahanKajianController::class,'index'])->name('kurikulum.bk.index');
    Route::post('/kurikulum/bahan-kajian', [BahanKajianController::class,'store'])->name('kurikulum.bk.store');
    Route::put('/kurikulum/bahan-kajian/{id}', [BahanKajianController::class,'update'])->name('kurikulum.bk.update');
    Route::delete('/kurikulum/bahan-kajian/{id}', [BahanKajianController::class,'destroy'])->name('kurikulum.bk.destroy');
    Route::post('/kurikulum/bahan-kajian/import', [BahanKajianController::class,'import'])->name('kurikulum.bk.import');
    Route::get('/kurikulum/bahan-kajian/template', [BahanKajianController::class,'template'])->name('kurikulum.bk.template');
});
// ======== MATA KULIAH ========
Route::middleware(['auth'])->group(function () {
    Route::get('/kurikulum/mata-kuliah', [MataKuliahController::class,'index'])->name('kurikulum.mk.index');
    Route::post('/kurikulum/mata-kuliah', [MataKuliahController::class,'store'])->name('kurikulum.mk.store');
    Route::put('/kurikulum/mata-kuliah/{id}', [MataKuliahController::class,'update'])->name('kurikulum.mk.update');
    Route::delete('/kurikulum/mata-kuliah/{id}', [MataKuliahController::class,'destroy'])->name('kurikulum.mk.destroy');
    Route::post('/kurikulum/mata-kuliah/import', [MataKuliahController::class,'import'])->name('kurikulum.mk.import');
    Route::get('/kurikulum/mata-kuliah/template', [MataKuliahController::class,'template'])->name('kurikulum.mk.template');
});
// ======== PEMETAAN CPL - PL ========
Route::middleware(['auth'])->group(function () {
    Route::get('/kurikulum/pemetaan/cpl-pl', [PemetaanController::class,'cplPl'])->name('kurikulum.pemetaan.cpl_pl');
    Route::post('/kurikulum/pemetaan/cpl-pl/store', [PemetaanController::class,'storeCplPl'])->name('kurikulum.pemetaan.cplpl.store');
    Route::post('/kurikulum/pemetaan/cpl-pl/delete',[PemetaanController::class, 'destroyCplPl'])->name('kurikulum.pemetaan.cplpl.delete');
});
// ======== PEMETAAN CPL - BK ========
Route::middleware(['auth'])->group(function () {
    Route::get('/kurikulum/pemetaan/cpl-bk',[PemetaanController::class,'cplBk'])->name('kurikulum.pemetaan.cpl_bk');

    Route::post('/kurikulum/pemetaan/cpl-bk/store',
        [PemetaanController::class,'storeCplBk']
    )->name('kurikulum.pemetaan.cplbk.store');

    Route::post('/kurikulum/pemetaan/cpl-bk/delete',
        [PemetaanController::class,'destroyCplBk']
    )->name('kurikulum.pemetaan.cplbk.delete');
});
// ======== PEMETAAN BK - MK ========
Route::middleware(['auth'])->group(function () {
    Route::get('/kurikulum/pemetaan/bk-mk',[PemetaanController::class,'bkMk'])->name('kurikulum.pemetaan.bk_mk');
    Route::post('/kurikulum/pemetaan/bk-mk/store',[PemetaanController::class,'storeBkMk'])->name('kurikulum.pemetaan.bkmk.store');
    Route::post('/kurikulum/pemetaan/bk-mk/delete',[PemetaanController::class,'destroyBkMk'])->name('kurikulum.pemetaan.bkmk.delete');
});
// ========= PEMETAAN CPL - MK ========
Route::middleware(['auth'])->group(function () {
    Route::get('/kurikulum/pemetaan/cpl-mk',[PemetaanController::class,'cplMk'])->name('kurikulum.pemetaan.cpl_mk');
    Route::post('/kurikulum/pemetaan/cpl-mk/store',[PemetaanController::class,'storeCplMk'])->name('kurikulum.pemetaan.cplmk.store');
    Route::post('/kurikulum/pemetaan/cpl-mk/delete',[PemetaanController::class,'destroyCplMk'])->name('kurikulum.pemetaan.cplmk.delete');
});
// ======== PENYUSUNAN MATA KULIAH ========
Route::middleware(['auth'])->group(function () {
    Route::get('/kurikulum/penyusunan',
        [PenyusunanMkController::class,'index']
    )->name('kurikulum.penyusunan.index');
    Route::post('/kurikulum/penyusunan',
        [PenyusunanMkController::class,'store']
    )->name('kurikulum.penyusunan.store');
});
    /*
    |--------------------------------------------------------------------------
    | PROFILE (DARI LARAVEL BREEZE)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH BREEZE (WAJIB TETAP ADA)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
