<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CplPl extends Model
{
    protected $table = 'cpl_pl';

    protected $fillable = [
        'cpl_id',
        'pl_id'
    ];

    public $timestamps = false;
}
