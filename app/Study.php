<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    protected $fillable = ['study_name', 'textlocal_api', 'redcap_api', 'url','phone_event', 'phone_variable', 'sms_invitations', 'logo'];

}
