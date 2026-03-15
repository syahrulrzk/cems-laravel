<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';
    protected $primaryKey = 'activity_id';
    protected $fillable = [
        'activity_title',
        'activity_cat',
        'activity_desc',
        'activity_status',
        'activity_from',
        'activity_to',
    ];
}
