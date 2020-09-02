<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'AT_ID';
     protected $table = 'audit_trail';
     protected $fillable = [
        'AT_USER_ID', 'AT_USER_NAME', 'AT_IP_ADDRESS','AT_DATE_TIME',
        'AT_ACTION_PERFORMED','AT_STATUS','AT_USER_TYPE'
    ];
}
