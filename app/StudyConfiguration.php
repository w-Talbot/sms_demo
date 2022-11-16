<?php

namespace App;

use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\Model;

class StudyConfiguration extends Model
{
    use RevisionableTrait;
    protected $table = 'studies';

}
