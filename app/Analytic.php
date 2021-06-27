<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    protected $fillable = array('user_id','publisher_id','type');

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function publisher()
    {
        return $this->belongsTo('App\Publisher');
    }
}
