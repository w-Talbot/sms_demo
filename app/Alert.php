<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = [
        'study_id',
        'record_id_variable_name',
        'record_id',
        'first_sent',
        'last_sent',
        'times_sent',
        'form_event',
        'form_variable',
        'num_of_recurrences',
        'send_every_num_days'
    ];
}
