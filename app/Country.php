<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{   
    protected $fillable = array( 'name','phonecode');

    public function states()
    {
        return $this->hasMany('App\State');
    }
}