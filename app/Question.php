<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    
    protected $fillable=['order','name_fr','name_ar',
    'text_fr','text_ar','type','page_id','rules','withNote'];
    

    //

    /*
    public function survey() { 
        return $this->belongsTo(Survey::class); 
    }
   */
    public function page() { 
        return $this->belongsTo(Page::class); 
    }

    public function responses() 
    { 
        return $this->hasMany(Response::class); 
    }
       
}
