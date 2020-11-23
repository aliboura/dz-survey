<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surveyreport extends Model
{
    protected $fillable=['survey_id','note','total_note','percentage'];

}
