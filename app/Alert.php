<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'first_sent', 'last_send', 'times_sent', 'first_send_time','last_send_time'];
}
