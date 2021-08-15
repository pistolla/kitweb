@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg" >
        <div class="container">
        <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="970x250"></div> <script class="adScriptClass" src="http://localhost//ads/ad.js"></script>
            <div class="row">

                <div class="col-lg-12">
                    <div class="breadcrumb-inner p-2">
                        <h4 class="title">{{$post->heading}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="blog-details-page-conent">
        <div class="container">
        <div class="blog-details-img">
            <img src="{{ asset('/images/blog') }}/{{$post->photo}}" style="width:100%;" alt="blog images">
        </div>
            <div class="row">
               <div class="col-lg-8 col-md-12 single-blog-details-inner-wrapper">
                    <div class="single-blog-details-post"><!-- single blog page -->
                        <div class="content">
                        <div class="post-meta d-flex justify-content-between">
                                <div class="mr-auto">
                                <span class="time ml-1"><i class="far fa-user">Admin</i></span>
                                
                                <span class="time"><i class="far fa-calendar"></i> {{$post->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="ml-auto">
                            @if(Auth::guard('feed')->check())
                                @if (auth()->user() && !$post->likedBy(auth()->user()))
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
                                      <button class="comment-dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i>{{ $post->dislikes}}</button>
                                  </form>
                                @endif
                              @endif 
                              </div>
                            </div>
                            
                            <p>{!!$post->details!!}</p>
                        </div>
                    </div> 


                    <div class="row">
    <div class="col-12">
      <div class="comments">
        <div class="comments-details">
          <span class="total-comments comments-sort">{{$post->comments->count()}} Comments</span>
          <span class="dropdown">
              <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">Sort By <span class="caret"></span></button>
              <div class="dropdown-menu">
                <a href="#" class="dropdown-item">Top Comments</a>
                <a href="#" class="dropdown-item">Newest First</a>
              </div>
          </span>     
        </div>
        <div class="comment-box add-comment">
          <span class="commenter-pic">
            <img src="/images/user-icon.jpg" class="img-fluid">
          </span>
          <span class="commenter-name">
            <form class="form" method="POST" action="{{ route('blog.blogcomment',$post)}}" name="contact-form">
              @csrf
              <input type="text" placeholder="Add a public comment" name="comment">
              <button type="submit" class="btn btn-default">Comment</button>
              <button type="cancel" class="btn btn-default">Cancel</button>
            </form>
          </span>
        </div>

        @foreach ($post->comments as $comment)
          <div class="comment-box replied">
            <span class="commenter-pic">
              <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid">
            </span>
            <span class="commenter-name">
              <a href="#">{{ $comment->member->username }}</a> <span class="comment-time">{{ $comment->created_at->diffForHumans()}}</span>
            </span>       
            <p class="comment-txt more">{{ $comment->text }}</p>
            <div class="comment-meta d-flex justify-content-end">
            
              @if (!$post->likedBy($comment->member))
                <form action="{{ route('blog.commentlikes', $comment) }}" method="post" class="mr-1">
                    @csrf
                    <input type="hidden" name="comment" value="{{$comment->id}}">
                    <button class="comment-like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$comment->likes->count()}}</button>
                </form>
              @else
                <form action="{{ route('blog.commentdislikes', $comment) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="comment" value="{{$comment->id}}">
                    <button class="comment-dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i>{{ $comment->dislikes->count()}}</button>
                </form>
              @endif
            
            <button class="comment-reply reply-popup"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>         
            </div>
            <div class="comment-box add-comment reply-box">
            <span class="commenter-pic">
              <img src="/images/user-icon.jpg" class="img-fluid">
            </span>
            <span class="commenter-name">
              <form action="{{ route('blog.comment', $comment) }}" method="post" class="mr-1">
                @csrf
                <input type="text" placeholder="Add a public reply" name="comment">
                <button type="submit" class="btn btn-default">Reply</button>
                <button type="cancel" class="btn btn-default reply-popup">Cancel</button>
              </form>
            </span>
          </div>

            
          </div>
          @endforeach
      </div>
    </div>
  </div>
               </div>
               <div class="col-lg-4 col-md-12">
                        <div class="blog-sidebar">
                        <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="728x90"></div> <script class="adScriptClass" src="http://localhost//ads/ad.js"></script>
                            <div class="widget widget_search">
                                <form action="#" class="search-form input-group">
                                    <div class="input-group">
                                      <input type="search" class="form-control widget_input" name="search" placeholder="Search">
                                      <div class="input-group-append">
                                        <button type="submit" class="input-group-btn btn"><i class="fa fa-search" araia-hidden="true"></i></button>
                                      </div>
                                    </div>
                                </form>
                            </div>
                            <div class="widget widget_categorie">
                                <h3 class="sidebar_title">Categories</h3>
                                <ul class="list-unstyled">
                                    @foreach ($categorys->unique('name') as $category)
                                        <li><a href="#"><i class="far fa-caret-right"></i>{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widget widget_post">
                                <h3 class="sidebar_title">Latest News</h3>
                                @foreach ($related as $new)
                                <div class="media post_item">
                                    <img src="{{ asset('/images/blog') }}/{{$new->photo}}" alt="loading...">
                                    <div class="media-body">
                                        <a href="#">
                                            <h5>{{substr($new->heading,0,30)}}...</h5>
                                        </a>
                                        <div class="p_date"><i class="far fa-calendar"></i>{{$new->created_at->diffForHumans()}}</div>
                                    </div>
                                </div> 
                                @endforeach
                            </div>
                            <div class="widget widget_tag">
                                <h3 class="sidebar_title">Popular Tags</h3>
                                <ul class="list-unstyled">
                                    @foreach (explode(',', $post->tags) as $tag)
                                    <li><a href="#" class="tag">{{$tag}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widget widget_archive">
                                <h3 class="sidebar_title">Archive Posts</h3>
                                <ul class="list-unstyled navbar-nav">
                                    <li class="archive_nav_item active">
                                        <a href="#"><i class="arrow_triangle-right"></i>January (25)</a>
                                        <ul class="list-unstyled dropdown-menu">
                                            <li><a href="#">Marketing (05)</a></li>
                                            <li><a href="#">Design (05)</a></li>
                                            <li><a href="#">Branding (05)</a></li>
                                            <li><a href="#">Playing (05)</a></li>
                                            <li><a href="#">Browsing (05)</a></li>
                                        </ul>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>

    @endsection