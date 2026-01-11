<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Kaprodi extends Model
{
    protected $table = 'kaprodi';

    protected $fillable = [
        'fakultas_id',
        'prodi_id',
        'tahun',
        'nama_kaprodi',
        'nip'
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
