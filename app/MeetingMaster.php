<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingMaster extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'mm_id';
     protected $table = 'meeting_master';
     protected $fillable = [
        'mm_title', 'mm_description', 'mm_um_id','mm_status'
    ];
}
