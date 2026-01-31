<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndikatorMk extends Model
{
    protected $table = 'indikator_mk';

    protected $fillable = [
        'indikator_cpl_id',
        'mk_id'
    ];

    public function indikator()
    {
        return $this->belongsTo(IndikatorCpl::class, 'indikator_cpl_id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mk_id');
    }
}
