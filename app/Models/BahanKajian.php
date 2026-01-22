<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanKajian extends Model
{
    protected $table = 'bahan_kajian';

    protected $fillable = [
        'kode_bahan_kajian',
        'nama_bahan_kajian',
        'deskripsi',
        'kurikulum_id'
    ];
    public function cpls()
    {
        return $this->belongsToMany(
            Cpl::class,
            'cpl_bk',
            'bk_id',
            'cpl_id'
        );
    }

    public function mataKuliah()
    {
        return $this->belongsToMany(
            MataKuliah::class,
            'bk_mk',
            'bk_id',
            'mk_id'
        );
    }

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class);
    }
}
