<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DosenController;



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
