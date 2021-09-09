@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
  <div class="container">
    <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="970x250"></div>
  </div>
</section>
<section onload="setInterval('forum.refresh()', 5000)">
  <div class="container">
    <!-- Current Tasks -->
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
            <div class="comments">
              <div class="comments-details d-flex">
                <span class="total-comments comments-sort h2">Members Posts</span>
                @if(!Auth::guard('feed')->check())
                <span class="pull-right ml-auto">
                  <a class="btn btn-info" href="{{route('feed.login')}}">Login as member to post <i class="fa fa-lock"></i></a>
                </span>
                @endif
              </div>
              @if(Auth::guard('feed')->check())
              <div class="comment-box add-comment">
                <form id="forum-form" class="contact-form" method="POST" action="{{ route('feed.newactivity') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="border border-primary rounded p-3">
                    <input type="text" class="form-control border-0 p-2" placeholder="Add a title" name="heading" required autofocus />
                    <textarea class="form-control border-0" placeholder="Write a post" name="details" rows="3"></textarea>
                  </div>
                  <div class="preview-panel d-flex justify-content-start" id="preview"></div>
                  <input type="hidden" id="linkurl" name="link_url" />
                  <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-media btn-file"><i class="fa fa-image"></i><input id="custom-file-input" type="file" name="photos" multiple></button>
                    <button type="button" class="btn btn-media" data-target="#linkModal" data-toggle="modal"><i class="fa fa-link"></i></button>
                    <button type="submit" class="btn btn-default">Post</button>
                    <button type="cancel" class="btn btn-default">Cancel</button>
                  </div>
                </form>
              </div>
              @endif
              <div id="activity-area">
                @if (isset($post))
                <div class="comment-box">
                  <span class="commenter-pic">
                    <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid">
                  </span>
                  <span class="commenter-name">
                    <a href="{{ route('feed.fetch', $post->slug) }}">{{ $post->heading }}</a>
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
                    <form action="{{ route('feed.postlikes') }}" method="post" class="mr-1">
                      @csrf
                      <input type="hidden" name="activity" value="{{$post->id}}">
                      <button class="comment-like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$post->likes->count()}}</button>
                    </form>
                    @else
                    <form action="{{ route('feed.postdislikes', $post) }}" method="post" class="mr-1">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="activity" value="{{$post->id}}">
                      <button class="comment-like"><i class="fa fa-thumbs-up" aria-hidden="true" style="color: blue;"></i> {{ $post->likes->count()}}</button>
                    </form>
                    @endif
                    @endif
                    <button class="comment-reply reply-popup" id="{{$post->id}}"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>


                    <span class="share-button sharer" style="display: inline-block;">
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
                          <button type="submit" class="btn btn-default">Reply</button>
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
                        <button class="comment-like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$comment->likes->count()}}</button>
                      </form>
                      @else
                      <form action="{{ route('feed.commentdislikes') }}" method="post" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="comment" value="{{$comment->id}}">
                        <button class="comment-like"><i class="fa fa-thumbs-up" aria-hidden="true" style="color: blue;"></i> {{ $comment->likes->count()}}</button>
                      </form>
                      @endif
                      @endif
                      <button class="comment-reply"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>
                    </div>
                  </div>
                  @endforeach

                </div>
                @endif

                @foreach ($activities as $activity)
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
                  @if (isset($activity->image_url))
                  <div class="card" style="border: none; background-color: transparent;">
                    <img class="card-img-top" src="{{ asset('/images/community/'.$activity->image_url)}}" alt="loading...">
                    <div class="card-body">
                      <p class="card-txt">{{ $activity->details }}</p>
                    </div>
                  </div>
                  @elseif (isset($activity->link_url))
                  @php
                  $embed = new Embed\Embed();
                  $embed->get($activity->link_url);
                  @endphp
                  <div class="card" style="border: none;">
                    <div class="card-body">
                      <div class="card-title">{{$embed->title}}</div>
                      <img class="card-img-top" src="{{ $embed->image }}" alt="loading...">
                      <p class="card-txt">{{ $activity->details }}</p>
                    </div>
                  </div>
                  @else
                  <p class="comment-txt">{{ $activity->details }}</p>
                  @endif
                  <div class="comment-meta d-flex justify-content-end">
                    @if(Auth::guard('feed')->check())
                    @if (!$activity->likedBy($post->member))
                    <form action="{{ route('feed.postlikes') }}" method="post" class="mr-1">
                      @csrf
                      <input type="hidden" name="activity" value="{{$activity->id}}">
                      <button class="comment-like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$activity->likes->count()}}</button>
                    </form>
                    @else
                    <form action="{{ route('feed.postdislikes') }}" method="post" class="mr-1">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" name="activity" value="{{$activity->id}}">
                      <button class="comment-like"><i class="fa fa-thumbs-up" aria-hidden="true" style="color: blue;"></i> {{ $activity->likes->count()}}</button>
                    </form>
                    @endif
                    @endif
                    <button class="comment-reply reply-popup" id="{{$activity->id}}"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>

                    <span class="share-button sharer" style="display: inline-block;">
                      <button class="comment-share" data-button="{{ url('/').'feed/'.$activity->id}}"><i class="fa fa-share" aria-hidden="true"></i> Share</button>
                      <span class="social top center networks-5 d-flex">
                        <!-- Facebook Share Button -->
                        <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u={{url('/').'/feed/'.$activity->slug}}"><i class="fab fa-facebook-f"></i></a>
                        <!-- Google Plus Share Button -->
                        <a class="fbtn share whatsapp" href="whatsapp://send?text={{url('/').'/feed/'.$activity->slug}}" data-action="share/whatsapp/share"><i class="fab fa-whatsapp"></i></a>
                        <!-- Twitter Share Button -->
                        <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text={{$activity->heading}}&amp;url={{url('/').'/feed/'.$post->slug}}&amp;via=Kenyansintexas"><i class="fab fa-twitter"></i></a>
                      </span>
                    </span>



                  </div>
                  <div class="comment-box add-comment reply-box" id="reply-{{$activity->id}}">
                    <span class="commenter-pic">
                      <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid">
                    </span>
                    <div class="row">
                      <form class="contact-form col-md-12" method="POST" action="{{ route('feed.commentpost') }}">
                        @csrf
                        <input type="hidden" name="activity" value="{{ $activity->id }}" />
                        <textarea class="form-control" placeholder="Add a public reply" rows="2" name="comment"></textarea>
                        <button type="submit" class="btn btn-default">Reply</button>
                        <button type="cancel" class="btn btn-default reply-popup">Cancel</button>
                      </form>
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
@endsection
@section('page-scripts')
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

