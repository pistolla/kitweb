<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Member;
use App\Like;

class Activity extends Model
{
    protected $fillable = array('heading', 'details', 'member_id');

    public function likedBy(Member $member)
    {
        return $this->likes->contains('member_id', $member->id);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}