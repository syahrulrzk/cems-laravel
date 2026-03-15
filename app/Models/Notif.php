<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notif extends Model
{
    protected $table = 'notif';
    protected $primaryKey = 'notif_id';
    public $timestamps = false;
    protected $fillable = [
        'notif_data',
        'notif_status',
    ];
}
