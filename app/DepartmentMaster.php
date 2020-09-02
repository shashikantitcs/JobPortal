<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentMaster extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'dm_id';
     protected $table = 'department_master';
     protected $fillable = [
        'dm_name', 'dm_short_name', 'dm_description','dm_status',
        'dm_head_id'
    ];
}
