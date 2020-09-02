<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobAd extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'ja_id';
     protected $table = 'job_ad';
     protected $fillable = [
        'ja_post', 'ja_no_of_post', 'ja_classification','ja_particulars_of_pay',
        'ja_qualification','ja_eligibilty','ja_max_age','ja_last_date_submission',
        'ja_type',' ja_pay_scale '
    ];
}
