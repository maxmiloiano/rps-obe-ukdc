<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MkPrasyarat extends Model
{
    protected $table = 'mk_prasyarat';

    protected $fillable = [
        'mk_id',
        'prasyarat_id'
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mk_id');
    }

    public function prasyarat()
    {
        return $this->belongsTo(MataKuliah::class, 'prasyarat_id');
    }
     public function penyusunanPrasyarat()
    {
        return $this->hasOne(
            PenyusunanMk::class,
            'mk_id',
            'prasyarat_id'
        );
    }
}
