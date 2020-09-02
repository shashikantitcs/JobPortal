<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaTaskAction extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ata_id';
     protected $table = 'agenda_task_action';
     protected $fillable = [
        'ata_action_taken', 'ata_remarks', 'ata_atl_id','ata_um_id'
    ];
}
