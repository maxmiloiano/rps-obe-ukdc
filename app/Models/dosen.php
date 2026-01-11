<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    public $timestamps = false; // karena tabel dosen tidak punya created_at

    protected $fillable = [
        'nip_nik',
        'nama_dosen',
        'nidn',
        'email',
        'prodi_id',
        'fakultas_id'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }
}
