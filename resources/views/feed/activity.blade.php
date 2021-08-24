@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="970x250"></div>
    </div>
</section>
<section>
    <div class="container">
    <div class="row">
          <div class="col-lg-3 mb-4">
            <div class="blog-sidebar">
               
            <div class="widget widget_search my-2">
                  <form action="{{ route('feed.searchpost')}}" method="GET" class="search-form input-group">
                    @csrf
                    <div class="input-group">
                      <input type="search" class="form-control widget_input" name="search" placeholder="Search">
                      <div class="input-group-append">
                      <button type="submit" class="input-group-btn btn"><i class="fa fa-search" araia-hidden="true"></i></button>
                      </div>
                      </div>
                  </form>
              </div>
              <div class="widget widget_categorie">
                  <ul class="list-unstyled">
                  <li class="mb-1 link h4"><a href="#"><i class="far fa-caret-right"></i>Trending</a></li>
                  <li class="mb-1 link h4"><a href="#"><i class="far fa-caret-right"></i>Most recent</a></li>
                  <li class="mb-1 link h4"><a href="#"><i class="far fa-caret-right"></i>Related</a></li>
                  </ul>
              </div>
              <div class="widget">
              <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="728x90"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-9 col-sm-12 mb-4">

          <div class="panel panel-info">
        <div class="panel-body">
        @if (isset($post))
          <div class="comment-box">
            <span class="commenter-pic">
              <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid img-avatar" height="65" width="65" alt="user_avatar">
            </span>
            <span class="commenter-name h2">
              <a href="#">{{ $post->heading }}</a>
            </span>
            <span class="commenter-name">
              <small> <span class="comment-time"></span></small>
            </span>       
            @if (isset($post->image_url))
              <div class="card" style="border: none;">
                <img class="card-img-top" src="{{ asset('/images/community/'.$post->image_url)}}" alt="loading...">
                <div class="card-body">
                  <p class="card-txt">{{ $post->details }}</p>
                </div>
              </div>
            @elseif (isset($post->link_url))
            <div class="card" style="border: none;">
                <div class="card-body">
                  <div class="card-title">
                    <object type="text/html" data="{{$post->link_url}}" height="200px" style="overflow: auto; border: 1px ridge black">
                    </object>
                  </div>
                  <p class="card-txt">{{ $post->details }}</p>
                </div>
              </div>
            @else
              <p class="comment-txt">{{ $post->details }}</p>
            @endif

            <div class="comment-meta d-flex justify-content-end">
            @if(Auth::guard('feed')->check())
                @if (!$post->likedBy($post->member))
                  <form action="{{ route('feed.postlikes', $post) }}" method="post" class="mr-1">
                      @csrf
                      <input type="hidden" name="activity" value="{{$post->id}}">
                      <button class="comment-like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$post->likes->count()}}</button>
                  </form>
                @else
                  <form action="{{ route('feed.postdislikes', $post) }}" method="post" class="mr-1">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="activity" value="{{$post->id}}">
                      <button class="comment-dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i>{{ $post->dislikes->count()}}</button>
                  </form>
                @endif
              @endif 
                <button class="comment-reply reply-popup" id="{{$post->id}}"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>
                <button class="comment-share" data-button="{{ url('/').'feed/'.$post->id}}"><i class="fa fa-share" aria-hidden="true"></i> Share</button>         
              
            </div>

            @if(Auth::guard('feed')->check())
            <div class="comment-box add-comment reply-box" id="reply-{{$post->id}}">
              <span class="commenter-pic">
                <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid img-avatar">
              </span>
              <div class="row">
                <form class="contact-form col-md-12" method="POST" action="{{ route('feed.commentpost') }}">
                      @csrf
                      <input type="hidden" name="activity" value="{{ $post->id }}" />
                      <textarea class="form-control" placeholder="Add a public reply" rows="2" name="comment"></textarea>
                      <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-default reply-popup mr-1">Reply</button>
                        <button type="cancel" class="btn btn-default  mr-1">Cancel</button>
                      </div>
                </form>
              </div>
            </div>
            @endif

            @foreach ($post->comments as $comment)
            <div class="comment-box replied">
              <span class="commenter-pic">
                <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid img-avatar">
              </span>
              <span class="commenter-name">
                <a href="#">{{ $comment->member->username }}</a> <span class="comment-time">{{ $comment->created_at->diffForHumans()}}</span>
              </span>       
              <p class="comment-txt more">{{ $comment->text }}</p>
              <div class="comment-meta d-flex justify-content-end">
              @if(Auth::guard('feed')->check())
                @if (!$post->likedBy($comment->member))
                  <form action="{{ route('feed.commentlikes', $comment) }}" method="post" class="mr-1">
                      @csrf
                      <input type="hidden" name="comment" value="{{$comment->id}}">
                      <button class="comment-like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$comment->likes->count()}}</button>
                  </form>
                @else
                  <form action="{{ route('feed.commentdislikes', $comment) }}" method="post" class="mr-1">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="comment" value="{{$comment->id}}">
                      <button class="comment-dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i>{{ $comment->likes->count()}}</button>
                  </form>
                @endif
                <button class="comment-reply"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>
              @endif
              </div>
            </div>
            @endforeach
            
          </div>
          @endif
        </div>
        </div>
        </div>
    </div>
</section>
@stop