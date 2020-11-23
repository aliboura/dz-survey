<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{

    protected $fillable=['code','name','description',
    'active','multi-lang','color','title','subtitle',
    'shape','using_icons','total_notes',
     'uid','has_notes','with_auth'];




    //
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /*
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    */
}
