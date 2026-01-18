<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetProdi extends Model
{
    protected $table = 'set_prodi_tahun';

    protected $fillable = [
        'fakultas_id',
        'prodi_id',
        'tahun_kurikulum',
        'status'
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
