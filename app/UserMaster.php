<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMaster extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'um_id';
     protected $table = 'user_master';
     protected $fillable = [
        'um_email', 'um_mobile', 'um_first_name','um_last_name',
        'um_password','um_status','um_gender','um_user_type','um_designation','um_dm_id',
        'um_sm_id'
    ];
}
