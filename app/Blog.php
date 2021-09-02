<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Blog extends Model
{

    use Notifiable;

    
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($blog) {
            $blog->notify(new BlogPublished($blog))
        });
    }


    protected $fillable = array('photo', 'heading','details', 'tags', 'category_id', 'admin_id', 'slug');

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
