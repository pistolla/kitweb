<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Member;
use App\Like;
use App\Comment;
use App\PostView;
use Illuminate\Notifications\Notifiable;

class Activity extends Model
{
    use Notifiable;

    protected $fillable = array('heading', 'details', 'member_id', 'image_url', 'link_url', 'link_phone','slug','views','shares');

    public function likedBy(Member $member)
    {
        return $this->likes->contains('member_id', $member->id);
    }

    public function dislikedBy(Member $member)
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
    
    public function dislikes()
    {
        return $this->belongsTo(Like::class)->onlyTrashed();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function views()
    {
        return $this->hasMany(PostView::class);
    }
}