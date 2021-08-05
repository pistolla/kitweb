<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

Class State extends Model
{   
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}