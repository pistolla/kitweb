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
                            <!-- <h4 class="title">{{$post->heading}}</h4> -->
                            <div class="post-meta d-flex">
                                <div>
                                <span class="time"><i class="far fa-user">Admin</i></span>
                                </div>
                                <div>
                                <span class="time"><i class="far fa-calendar"></i> {{$post->created_at->diffForHumans()}}</span>
                                </div>
                            </div>
                            <p>{!!$post->details!!}</p>
                        </div>
                    </div> 


                    <div class="row">
    <div class="col-12">
      <div class="comments">
        <div class="comments-details">
          <span class="total-comments comments-sort">117 Comments</span>
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
            <input type="text" placeholder="Add a public comment" name="Add Comment">
            <button type="submit" class="btn btn-default">Comment</button>
            <button type="cancel" class="btn btn-default">Cancel</button>
          </span>
        </div>
        <div class="comment-box">
          <span class="commenter-pic">
            <img src="/images/user-icon.jpg" class="img-fluid">
          </span>
          <span class="commenter-name">
            <a href="#">Happy markuptag</a> <span class="comment-time">2 hours ago</span>
          </span>       
          <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
          <div class="comment-meta">
            <button class="comment-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 99</button>
            <button class="comment-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 149</button> 
            <button class="comment-reply reply-popup"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>         
          </div>
          <div class="comment-box add-comment reply-box">
            <span class="commenter-pic">
              <img src="/images/user-icon.jpg" class="img-fluid">
            </span>
            <span class="commenter-name">
              <input type="text" placeholder="Add a public reply" name="Add Comment">
              <button type="submit" class="btn btn-default">Reply</button>
              <button type="cancel" class="btn btn-default reply-popup">Cancel</button>
            </span>
          </div>
        </div>
        <div class="comment-box">
          <span class="commenter-pic">
            <img src="/images/user-icon.jpg" class="img-fluid">
          </span>
          <span class="commenter-name">
            <a href="#">Happy markuptag</a> <span class="comment-time">2 hours ago</span>
          </span>       
          <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
          <div class="comment-meta">
            <button class="comment-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 99</button>
            <button class="comment-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 149</button> 
            <button class="comment-reply"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>         
          </div>
          <div class="comment-box replied">
            <span class="commenter-pic">
              <img src="/images/user-icon.jpg" class="img-fluid">
            </span>
            <span class="commenter-name">
              <a href="#">Happy markuptag</a> <span class="comment-time">2 hours ago</span>
            </span>       
            <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
            <div class="comment-meta">
              <button class="comment-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 99</button>
              <button class="comment-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 149</button> 
              <button class="comment-reply"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>         
            </div>
            <div class="comment-box replied">
              <span class="commenter-pic">
                <img src="/images/user-icon.jpg" class="img-fluid">
              </span>
              <span class="commenter-name">
                <a href="#">Happy markuptag</a> <span class="comment-time">2 hours ago</span>
              </span>       
              <p class="comment-txt more">Suspendisse massa enim, condimentum sit amet maximus quis, pulvinar sit amet ante. Fusce eleifend dui mi, blandit vehicula orci iaculis ac.</p>
              <div class="comment-meta">
                <button class="comment-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 99</button>
                <button class="comment-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 149</button> 
                <button class="comment-reply"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>         
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




               </div>


               <div class="col-lg-4 col-md-12">
                        <div class="blog-sidebar">
                        <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="728x90"></div> <script class="adScriptClass" src="http://localhost//ads/ad.js"></script>
                            <div class="widget widget_search">
                                <form action="#" class="search-form input-group">
                                    <input type="search" class="form-control widget_input" placeholder="Search">
                                    <button type="submit"><i class="far fa-search"></i></button>
                                </form>
                            </div>
                            <div class="widget widget_categorie">
                                <h3 class="sidebar_title">Categories</h3>
                                <ul class="list-unstyled">
                                    @foreach ($categorys as $category)
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