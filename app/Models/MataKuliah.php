<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'deskripsi'
    ];

    public function bahankajian()
    {
        return $this->belongsToMany(
            BahanKajian::class,
            'bk_mk',
            'mk_id',
            'bk_id'
        );
    }
    public function cpls()
    {
        return $this->belongsToMany(
            Cpl::class,
            'cpl_mk',
            'mk_id',
            'cpl_id'
        );
    }
    public function penyusunan()
    {
        return $this->hasOne(PenyusunanMk::class, 'mk_id');
    }
    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class);
    }
    public function prasyarat()
    {
        return $this->hasMany(
        \App\Models\MkPrasyarat::class,
        'mk_id'
        );
    }
    public function mkDosen()
    {
        return $this->hasMany(MkDosen::class, 'mk_id');
    }
}
