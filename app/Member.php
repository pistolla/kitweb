<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Activity;
use App\Like;
use App\LinkedSocialAccount;

class Member extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','username', 'password','country','city','mobile','emailv','smsv','vercode','vsent','status','photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function accounts()
    {
        return $this->hasMany(LinkedSocialAccount::class);
    }
}
