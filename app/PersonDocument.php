<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonDocument extends Model
{
    public function person(){

        return $this->belongsTo(Person::class); 
    } 
}
