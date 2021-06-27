<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $fillable = array( 'user_id','gateway_id','amount','usd_amo','btc_amo','btc_wallet','trx','try','status');

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function gateway()
    {
        return $this->belongsTo('App\Gateway');
    }
}
