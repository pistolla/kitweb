<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adtype extends Model
{
    protected $fillable = array('name','type','width','height','slag','status');

    public function advertise()
    {
        return $this->hasMany('App\Advertise', 'id', 'adtype_id');
    }
    
}
