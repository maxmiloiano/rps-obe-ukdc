<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';

    protected $fillable = [
        'prodi_id',
        'tahun',
        'status'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function profilLulusan()
    {
        return $this->hasMany(ProfilLulusan::class);
    }
}
