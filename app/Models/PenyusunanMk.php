<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenyusunanMk extends Model
{
    protected $table = 'penyusunan_mk';

    protected $fillable = [
        'mk_id',
        'sks',
        'kategori',
        'semester'
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mk_id');
    }
}
