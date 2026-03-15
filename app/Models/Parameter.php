<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $table = 'parameter';
    protected $primaryKey = 'parameter_id';
    public $timestamps = false;
    protected $fillable = [
        'cerobong_id',
        'parameter_code',
        'parameter_name',
        'parameter_threshold',
        'parameter_portion',
        'parameter_color',
        'parameter_status',
        'parameter_sispek',
    ];
}
