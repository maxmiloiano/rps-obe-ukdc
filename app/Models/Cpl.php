<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\IndikatorCpl;


class Cpl extends Model
{
    protected $table = 'cpl';

    protected $fillable = [
        'kode_cpl',
        'deskripsi',
        'kurikulum_id'
    ];

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class);
    }
    public function indikator()
    {
        return $this->hasMany(IndikatorCpl::class);
    }
}
