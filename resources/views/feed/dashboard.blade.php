@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="970x250"></div> <script class="adScriptClass" src="http://localhost//ads/ad.js"></script>
    </div>
</section>
<section >
    <div class="container">
        <!-- Current Tasks -->
        <div class="row">
          <div class="col-lg-3 mb-4">
            <div class="blog-sidebar">
              <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="728x90"></div> 
              <script class="adScriptClass" src="http://localhost//ads/ad.js"></script>
            <div class="widget widget_search mb-2">
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
          <form class="contact-form" method="POST" action="{{ route('feed.newactivity') }}">
          @csrf
          <input type="text" class="form-control" placeholder="Add a title" name="heading" required autofocus/>
          <textarea class="form-control" placeholder="Create a post" name="details" rows="3"></textarea>
          <div class="preview-panel d-flex justify-content-start" id="preview"></div>
            <div class="d-flex justify-content-end">
            <button class="btn btn-media"><i class="fa fa-image" data-target="imagePicker"></i></button>
            <button class="btn btn-media"><i class="fa fa-link"></i></button>
            <button type="submit" class="btn btn-default">Post</button>
            <button type="cancel" class="btn btn-default">Cancel</button>
            </div>
          </form>
        </div>
        @endif
        <div class="comment-box">
          <span class="commenter-pic">
            <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid">
          </span>
          <span class="commenter-name">
            <a href="#">{{ $post->heading }}</a>
          </span>
          <span class="commenter-name">
            <small> <span class="comment-time"></span></small>
          </span>       
          <p class="comment-txt">{{ $post->details }}</p>
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
          <div class="comment-box add-comment reply-box" id="reply-{{$post->id}}">
            <span class="commenter-pic">
              <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid">
            </span>
            <span class="commenter-name">
              <form class="contact-form" method="POST" action="{{ route('feed.commentpost') }}">
                    @csrf
                    <input type="hidden" name="activity" value="{{ $post->id }}" />
                    <textarea class="form-control" placeholder="Add a public reply" rows="2" name="comment"></textarea>
                    <button type="submit" class="btn btn-default">Reply</button>
                    <button type="cancel" class="btn btn-default reply-popup">Cancel</button>
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
            @endif
            <button class="comment-reply"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>         
            </div>
          </div>
          @endforeach
          
        </div>

        @foreach ($activities as $activity)
        <div class="comment-box">
          <span class="commenter-pic">
            <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid">
          </span>
          <span class="commenter-name">
            <a href="#">{{ $activity->heading }}</a>
          </span>
          <span class="commenter-name">
            <small> <span class="comment-time"></span></small>
          </span>       
          <p class="comment-txt more">{{ $activity->details }}</p>
          <div class="comment-meta d-flex justify-content-end">
          @if(Auth::guard('feed')->check())
              @if (!$activity->likedBy($activity->member))
                <form action="{{ route('feed.postlikes', $activity) }}" method="post" class="mr-1">
                    @csrf
                    <button class="comment-like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> {{$activity->likes->count()}}</button>
                </form>
              @else
                <form action="{{ route('feed.postdislikes', $activity) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button class="comment-dislike"><i class="fa fa-thumbs-down" aria-hidden="true"></i>{{ $activity->likes->count()}}</button>
                </form>
              @endif
            @endif
            <button class="comment-reply reply-popup" id="{{$post->id}}"><i class="fa fa-reply-all" aria-hidden="true"></i> Reply</button>         
          </div>
          <div class="comment-box add-comment reply-box" id="reply-{{$activity->id}}">
            <span class="commenter-pic">
              <img src="{{ asset('/images/logo/icon.png') }}" class="img-fluid">
            </span>
            <span class="commenter-name">
              <form class="contact-form" method="POST" action="{{ route('feed.commentpost') }}">
                    @csrf
                    <input type="hidden" name="activity" value="{{ $activity->id }}" />
                    <textarea class="form-control" placeholder="Add a public reply" rows="2" name="comment"></textarea>
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
        </div>
        <!-- /.row -->

  <!-- Pagination -->
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#">1</a>
    </li>
    
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
    </li>
  </ul>

    </div>
    <div class="modal fade" id="imagePicker" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalLabel">Title</h4>
          </div>
          <div class="modal-body">
            <input type="file" class="form-control" name="file[]">
          </div>
        </div>
      </div>
    </div>
    </section>
@stop


