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
}
