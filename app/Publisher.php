<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Publisher extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','username', 'password','country','city','mobile','tauth','tfver','emailv','smsv','refer','balance','credit','status','vsent','vercode','secretcode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function analytic()
    {
        return $this->hasMany('App\Analytic', 'id', 'publisher_id');
    }
    
    public function withdraw()
    {
        return $this->hasMany('App\Withdraw', 'id', 'publisher_id');
    }

}
