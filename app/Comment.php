<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use SelfReferenceTrait;

    protected $fillable = array('text', 'member_id', 'activity_id', 'blog_id');

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}