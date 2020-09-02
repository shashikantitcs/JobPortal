<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaUserMapping extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'aum_id';
     protected $table = 'agenda_user_mapping';
     protected $fillable = [
        'aum_am_id', 'aum_um_id', 'aum_status','aum_user_type',
    ];
}
