<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    //
    
    protected $fillable=['text_ar','text_fr',
    'question_id','is_true','note','hasNote','complete_note','order'];

    public function question() { 
        return $this->belongsTo(Question::class); 
    }
    
}
