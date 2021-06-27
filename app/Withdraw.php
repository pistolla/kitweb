<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = array( 'publisher_id','wmethod_id','amount','account','status');

    public function publisher()
    {
        return $this->belongsTo('App\Publisher');
    }
    public function wmethod()
    {
        return $this->belongsTo('App\Wmethod');
    }
}
