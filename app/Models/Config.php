<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'config';
    protected $primaryKey = 'config_id';
    public $timestamps = false;
    protected $fillable = [
        'config_name',
        'config_value',
    ];
}
