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

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class);
    }
}
