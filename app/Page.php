<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model{

    
    protected $fillable=['name_fr','name_ar','survey_id',
    'description_fr','description_ar','code','icone'];
    //
    public function survey() { 
    return $this->belongsTo(Survey::class); 
}
   
public function questions() 
{ 
    return $this->hasMany(Question::class); 
}

}
