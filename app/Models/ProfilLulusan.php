<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilLulusan extends Model
{
    protected $table = 'profil_lulusan';

    protected $fillable = [
        'kode_pl',
        'deskripsi',
        'kurikulum_id'
    ];
    public function cpls()
    {
        return $this->belongsToMany(
            Cpl::class,
            'cpl_pl',
            'pl_id',
            'cpl_id'
        );
    }    

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class);
    }
}
