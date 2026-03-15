<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';
    public $timestamps = false;
    protected $fillable = [
        'parameter',
        'value',
        'waktu',
        'velocity',
        'laju_alir',
        'status_gas',
        'status_partikulat',
        'status',
        'fuel',
        'load',
        'status_sispek',
        'cerobong_id',
        'modified_at',
    ];
}
