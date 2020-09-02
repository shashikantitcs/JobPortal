<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionMaster extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'sm_id';
     protected $table = 'section_master';
     protected $fillable = [
        'sm_name', 'sm_short_name', 'sm_description','sm_status',
        'sm_dm_id'
    ];
}
