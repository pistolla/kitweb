<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = array('photo', 'heading','details', 'tags', 'category_id', 'admin_id');

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes()
    {
        return $this->belongsTo(Like::class)->onlyTrashed();
    }

    public function likedBy(Member $member)
    {
        return $this->likes->contains('member_id', $member->id);
    }
}
