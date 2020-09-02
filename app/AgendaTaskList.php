<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaTaskList extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'atl_id';
     protected $table = 'agenda_task_list';
     protected $fillable = [
        'atl_title', 'atl_description', 'atl_am_id','atl_um_id',
        'atl_status','atl_created_by','atl_expected_completion_date','atl_actual_completion_date'
    ];
}
