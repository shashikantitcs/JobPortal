<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingSchedule extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ms_id';
     protected $table = 'meeting_schedule';
     protected $fillable = [
        'ms_meeting_notice', 'ms_meeting_date', 'ms_meeting_time','ms_mm_id',
        'ms_status','ms_chaired_by','ms_created_by'
    ];
}
