<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cerobong extends Model
{
    protected $table = 'cerobong';
    protected $primaryKey = 'cerobong_id';
    public $timestamps = false;
    protected $fillable = [
        'cerobong_code',
        'cerobong_name',
        'cerobong_city',
        'cerobong_status',
        'cerobong_schedule',
        'cerobong_from',
        'cerobong_to',
        'cerobong_user',
        'cerobong_kirim_status',
    ];
}
