<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    protected $fillable=['question_code','response_code','survey_id','user'];
}
