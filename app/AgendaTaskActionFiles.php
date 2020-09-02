<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaTaskActionFiles extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'file_id';
     protected $table = 'agenda_task_action_files';
     protected $fillable = [
        'file_ata_id', 'file_atl_id', 'file_atl_id','file_name',
        'file_extension','file_size','file_real_name','status'
    ];
}
