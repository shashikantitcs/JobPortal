<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPasswordHistory extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'UPH_ID';
     protected $table = 'user_password_history';
     protected $fillable = [
        'UPH_UM_ID', 'UPH_PASSWORD',
    ];
}
