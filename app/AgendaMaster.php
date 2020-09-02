<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaMaster extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'am_id';
     protected $table = 'agenda_master';
     protected $fillable = [
        'am_title', 'am_description', 'am_mm_id','am_um_id',
        'am_expected_completion_date','am_actual_completion_date'
    ];
}
