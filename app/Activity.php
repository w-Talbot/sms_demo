<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
              'sms_alert_id',
        'sms_study_id',
        'redcap_record_id',
        'error_note',
        'error_message'
    ];
}
