<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Member;

class LinkedSocialAccount extends Model {
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_id', 'provider_name','provider_id'
    ];

    public function user()
    {
        return $this->belongsTo(Member::class);
    }
}