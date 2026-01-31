<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MkDosen extends Model
{
    protected $table = 'mk_dosen';

    protected $fillable = [
        'mk_id',
        'dosen_id'
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mk_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}
