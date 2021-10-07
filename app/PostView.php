<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    protected $fillable = array('blog_id', 'activity_id', 'user_id', 'slug', 'url', 'session_id', 'ip', 'agent');

    public static function recordView($post)
    {
        $postView = new PostView();
        if($post instanceof Activity)
            $postView->activity_id = $post->id;
        if($post instanceof Blog)
            $postView->blog_id = $post->id;
        $postView->url = \Request::url();
        $postView->session_id = \Request::getSession()->getId();
        $post->user_id = (\Auth::check()) ? \Auth::id() : null;
        $postView->agent = \Request::header('User-Agent');
        $postView->save();
    }
}
