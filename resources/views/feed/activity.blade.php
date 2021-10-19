@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
  <div class="container">
    <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="970x250"></div>
  </div>
</section>
<section>
  <div class="container">
    <!-- Current Tasks -->
    <div class="row">

      <div class="col-lg-9 col-sm-12 mb-4">
        <div class="panel panel-info mt-2">
          <div class="panel-body">
            <div class="comments">
              <div id="activity-area">
                @if (isset($post))
                <div class="comment-box">
                  <span class="commenter-pic">
                    <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid">
                  </span>
                  <span class="commenter-name">
                    <a href="{{ route('feed.fetch', $post->slug) }}" class="h4">{{ $post->heading }}</a><br>
                    <small>posted by</small> {{$post->member->username }} <small>{{$post->created_at->diffForHumans() }}</small>
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
                    <a href="tel:{{$post->link_phone}}" class="btn mx-2 comment-like"><i class="fa fa-phone" aria-hidden="true"></i> Call Now</a>
                    <a href="{{$post->link_url}}" class="btn mx-2 comment-like"><i class="fa fa-link" aria-hidden="true"></i> Website</a>
                    @if(Auth::guard('feed')->check())
                    @if (!$post->likedBy($post->member))
                    <form action="{{ route('feed.postlikes') }}" method="post" class="mr-1">
                      @csrf
                      <input type="hidden" name="activity" value="{{$post->id}}">
                      <button class="btn comment-like mt-1"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$post->likes->count()}}</button>
                    </form>
                    @else
                    <form action="{{ route('feed.postdislikes', $post) }}" method="post" class="mr-1">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="activity" value="{{$post->id}}">
                      <button class="btn comment-like mt-1"><i class="fa fa-thumbs-up" aria-hidden="true" style="color: blue;"></i> {{ $post->likes->count()}}</button>
                    </form>
                    @endif
                    @endif
                    <button class="btn comment-reply reply-popup mx-2" id="{{$post->id}}"><i class="fa fa-reply-all" aria-hidden="true"></i> Comment</button>


                    <span class="share-button sharer mt-2 mx-2" style="display: inline-block;">
                      <button class="comment-share" data-button="{{ url('/').'feed/'.$post->id}}"><i class="fa fa-share" aria-hidden="true"></i> Share</button>
                      <span class="social top center networks-5 d-flex">
                        <!-- Facebook Share Button -->
                        <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u={{url('/').'/feed/'.$post->slug}}"><i class="fab fa-facebook-f"></i></a>
                        <!-- Google Plus Share Button -->
                        <a class="fbtn share whatsapp" href="whatsapp://send?text={{url('/').'/feed/'.$post->slug}}" data-action="share/whatsapp/share"><i class="fab fa-whatsapp"></i></a>
                        <!-- Twitter Share Button -->
                        <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text={{$post->heading}}&amp;url={{url('/').'/feed/'.$post->slug}}&amp;via=Kenyansintexas"><i class="fab fa-twitter"></i></a>
                      </span>
                    </span>

                  </div>
                  <div class="comment-box add-comment reply-box" id="reply-{{$post->id}}">
                    <span class="commenter-pic">
                      <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid">
                    </span>
                    <div class="row">
                      <form class="contact-form col-md-12" method="POST" action="{{ route('feed.commentpost') }}">
                        @csrf
                        <input type="hidden" name="activity" value="{{ $post->id }}" />
                        <textarea class="form-control" placeholder="Add a public reply" rows="2" name="comment"></textarea>
                        <div class="d-flex justify-content-end">
                          <button type="submit" class="btn btn-default">Post</button>
                          <button type="cancel" class="btn btn-default reply-popup">Cancel</button>
                        </div>
                      </form>
                    </div>
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
                      @if(Auth::guard('feed')->check())
                      @if (!$comment->likedBy($post->member))
                      <form action="{{ route('feed.commentlikes') }}" method="post" class="mr-1">
                        @csrf
                        <input type="hidden" name="comment" value="{{$comment->id}}">
                        <button class="btn comment-like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$comment->likes->count()}}</button>
                      </form>
                      @else
                      <form action="{{ route('feed.commentdislikes') }}" method="post" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="comment" value="{{$comment->id}}">
                        <button class="btn comment-like"><i class="fa fa-thumbs-up" aria-hidden="true" style="color: blue;"></i> {{ $comment->likes->count()}}</button>
                      </form>
                      @endif
                      @endif
                      <button class="btn comment-reply"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>
                    </div>
                  </div>
                  @endforeach
                </div>
                @endif

                <div class="row">
                  <hr>
                </div>


                <div class="row">
                  @foreach ($suggested as $activity)
                  <div class="col-md-6">
                    <div class="comment-box">
                      <span class="commenter-pic">
                        <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid">
                      </span>
                      <span class="commenter-name">
                        <a href="{{ route('feed.fetch', $activity->slug) }}">{{ $activity->heading }}</a>
                      </span>
                      <span class="commenter-name">
                        <small> <span class="comment-time"></span></small>
                      </span>
                      <div class="card" style="border: none; background-color: transparent;">
                        <img class="card-img-top" src="{{ asset('/images/community/'.$activity->image_url)}}" alt="loading...">
                        <div class="card-body">
                          <p class="card-txt">{{ $activity->details }}</p>
                        </div>
                      </div>
                      <div class="comment-meta d-flex justify-content-center">
                        <a class="btn btn-info"><i class="fa fa-expand" aria-hidden="true"></i> View Ad</a>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

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
            <span class="badge badge-pill badge-info p-2 link h4"><a href="{{ route('feed.dashboard') }}"><i class="fa fa-check"></i>Trending</a></span>
              <span class="badge badge-pill badge-info p-2 link h4"><a href="{{ route('feed.dashboard') }}">Most recent</a></span>
              <span class="badge badge-pill badge-info p-2 link h4"><a href="{{ route('feed.dashboard') }}">Related</a></span>
              
                @if(!Auth::guard('feed')->check())
                <span class="pull-right ml-auto">
                  <a class="btn btn-info" href="{{route('feed.login')}}">Login as member to post <i class="fa fa-lock"></i></a>
                </span>
                @endif
          </div>
          <div class="widget">
            <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="728x90"></div>
          </div>
          <br>
          <div class="widget widget_categorie mt-5">
            <div class="card-body border border-secondary rounded">
              <div class="user-image d-flex justify-content-center">
                  <img src="{{url('/').'/images/community/'.$post->member->photo}}" class="rounded-circle bg-secondary" alt="{{$post->member->username}}" height="65" width="65">
              </div>
              <h5 class="h5">{{$post->member->name}} | <small>{{$post->member->status == 1 ? 'Active': 'Not Active'}}</small></h5>
              <p class="text-muted">Member since {{$post->member->created_at->diffForHumans()}}</p>
              <p class="text-muted">Activity Level: {{$activity_level}}%</p>
              <p class="mt-4 text-muted">{{ isset($pos->member->bio) ? $pos->member->bio : 'Add member you profile description.'}}</p>
              <hr>
              <div class="bg-blue counter-block mt-1 p-2">
                  <div class="row justify-content-center">
                      <div class="col-4">
                          <i class="fa fa-edit"></i>
                          <p>{{$total_posts}}</p>
                      </div>
                      <div class="col-4">
                        <i class="fa fa-comment"></i>
                        <p>{{$total_comments}}</p>
                    </div>
                  </div>
              </div>
              <hr>
              <div class="row justify-content-center user-social-link">
                  <div class="col-auto"><a href="{{$post->member->website}}"><i class="fa fa-link"></i></a></div>
                  <div class="col-auto"><a href="tel:{{$post->member->mobile}}"><i class="fa fa-phone"></i></a></div>
                  <div class="col-auto"><a href="{{$post->member->facebook}}"><i class="fab fa-facebook-f"></i></a></div>
                  <div class="col-auto"><a href="{{$post->member->whatsapp}}"><i class="fab fa-whatsapp"></i></a></div>
              </div>
            
          </div>
          </div>
          <div class="widget widget_categorie">
            @foreach ($suggested as $new)
            <div class="media post_item">
              <div class="media-body">
                <a href="{{route('feed.fetch', $new->slug)}}">
                  <h5>{{substr($new->heading,0,30)}}...</h5>
                </a>
                <div class="p_date">last update: {{$new->created_at->diffForHumans()}}</div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->


  </div>
  <div class="modal fade" id="linkModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" name="linkInput" id="linkInput" placeholder="paste or type a url">
          <div id="urlcontent" class="text-center"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save Link</button>
        </div>
      </div>
    </div>
  </div>
</section>
@section("page_scripts")
<script type="text/javascript" src="{{asset('/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/forum.js')}}"></script>
<script type="text/javascript">
  (function($) {
      "use strict";
      jQuery(document).ready(function($) {
        $(function() {
          var forum = new Forum();
          console.log(forum);
          userID = 1;
          lastID = 5;
          searchToken = "";
          forum.refresh();
          $("#forum-form").submit(function(event) {
            event.preventDefault();
            var form = $.this;
            var formData = new FormData(form);
            forum.send(formData);
          });

        });
      })(jQuery);
</script>
@endsection
@stop