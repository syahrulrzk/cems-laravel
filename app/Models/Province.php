<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'province';
    protected $primaryKey = 'province_id';
    public $timestamps = false;
    protected $fillable = [
        'province_name',
        'province_lt',
        'province_lg',
    ];
}
