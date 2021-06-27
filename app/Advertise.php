<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $fillable = array('user_id','adtype_id','link','hashid','photo','click','total','count_click','count_imp','status', 'category_id', 'category', 'description');

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function adtype()
    {
        return $this->belongsTo('App\Adtype');
    }
}
