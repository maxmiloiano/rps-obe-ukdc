<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndikatorCpl extends Model
{
    protected $table = 'indikator_cpl';

    protected $fillable = [
        'cpl_id',
        'kode_indikator',
        'deskripsi',
        'bobot'
    ];

    public function cpl()
    {
        return $this->belongsTo(Cpl::class);
    }
}
