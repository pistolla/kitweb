@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
  <div class="container">
    <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="970x250"></div>
  </div>
</section>
<section onload="setInterval('forum.refresh()', 5000)">
  <div class="container">
    <div class="row">
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
                    <hr>
                    <textarea class="form-control border-0" placeholder="Write a post" name="details" rows="3"></textarea>
                  </div>
                  <div class="preview-panel d-flex justify-content-start" id="preview"></div>
                  <div class="preview-panel row p-2">
                    <span class="col-4"><i class="fa fa-link"></i>&nbsp;<small id="preview-link">Not set</small></span>
                    <span class="col-4"><i class="fa fa-phone"></i>&nbsp;<small id="preview-phone">Not set</small></span>
                  </div>
                  <input type="hidden" id="linkurl" name="link_url" />
                  <input type="hidden" id="telephone" name="link_phone" />
                  <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-media btn-file"><i class="fa fa-image"></i><input id="custom-file-input" type="file" name="photos" multiple></button>
                    <button type="button" class="btn btn-media" data-target="#linkModal" data-toggle="modal"><i class="fa fa-link"></i></button>
                    <button type="button" class="btn btn-media" data-target="#linkModal" data-toggle="modal"><i class="fa fa-phone"></i></button>
                    <button type="submit" class="btn btn-default">Post</button>
                    <button type="cancel" class="btn btn-default">Clear</button>
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
                    <a href="{{ route('feed.fetch', $post->slug) }}" class="h4">{{ $post->heading }}</a><br>
                    <small>posted by</small> {{$post->member->username }} <small>{{ $post->created_at->diffForHumans() }} </small>
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
                    <a href="{{ route('feed.fetch', $activity->slug) }}" class="h4">{{ $activity->heading }}</a><br>
                    <small>posted by</small> {{$activity->member->username }} <small>{{$activity->created_at->diffForHumans() }}</small>
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
                  try {
                    $embed = new Embed\Embed();
                    $embed->get($activity->link_url);
                   } catch (\Exception $e){
                   }
                  @endphp
                  <div class="card" style="border: none;">
                    <div class="card-body">
                      <div class="card-title">{{isset($embed->title) ? $embed->title : $activity->heading }}</div>
                      <img class="card-img-top" src="{{ isset($embed->image) ? $embed->image : asset('/images/community/broken_link.jpg') }}" alt="loading...">
                      <p class="card-txt"><a href="{{ $activity->link_url }}" title="{{ $activity->link_url }}">{{ $activity->details }}</a></p>
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
              <div class="row">
                <div class="col-md-12">
                {{$activities->links("pagination::bootstrap-4")}}
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
            <span class="badge badge-pill badge-info p-2 link h4"><a href="{{ route('feed.dashboard', 'trending') }}">
              @if ($tag === 'trending')
                <i class="fa fa-check"></i>
              @endif
              Trending</a></span>
            <span class="badge badge-pill badge-info p-2 link h4"><a href="{{ route('feed.dashboard', 'recent') }}">
              @if ($tag === 'recent')
                <i class="fa fa-check"></i>
              @endif
              Most recent</a></span>
            <span class="badge badge-pill badge-info p-2 link h4"><a href="{{ route('feed.dashboard', 'related') }}">
              @if ($tag === 'related')
                <i class="fa fa-check"></i>
              @endif
              Related</a></span>
          </div>
          <div class="widget">
            <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="728x90"></div>
          </div>
          <h5 class="underlined">Members available</h5>
            <hr>
          <div class="widget d-flex flex-wrap">
            @php
              $members = [$post->member->id];
            @endphp
            <h4 class="badge badge-pill badge-info m-2 pl-0"><a class="p-0 m-0" href="{{ route('feed.dashboard', $post->member->username)}}"><img class="rounded-circle bg-secondary mr-auto" src="{{ asset('/images/community').'/'.$post->member->photo}}" alt=":)" height="30" width="30">&nbsp;{{$post->member->name}}</a><h4>
             
            @foreach ($activities as $activity)
              
              @if (!in_array($activity->member->id,$members))
                <h4 class="badge badge-pill badge-info m-2 pl-0"><a class="p-0 m-0" href="{{ route('feed.dashboard', $activity->member->username)}}"><img class="rounded-circle bg-secondary mr-auto" src="{{ asset('/images/community').'/'.$activity->member->photo}}" alt=":)" height="30" width="30">&nbsp;{{$activity->member->name}}</a><h4>
              @endif
              @php
                $members[] = $activity->member->id;
              @endphp
            @endforeach
          </div>
          <div class="widget">
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
          <input type="text" class="form-control mb-2" name="linkInput" id="linkInput" placeholder="Enter ad URL">
          <div id="urlcontent"></div>
          <input type="tel" id="phoneInput" class="form-control" name="phoneInput" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" placeholder="Enter ad phone">
          <div id="phonecontent"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="saveLink">Save Link</button>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('page_scripts')
<script type="text/javascript" src="{{asset('/js/forum.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
        var timer;
        var delay = 600;
        var regexp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        var validUrl = '';
        var validPhone = '';
        $('#linkInput').on('input',function(e){
          $('#urlcontent').html("<span class='text-info'>Loading... "+e.target.value+"</span>");
          if(e.target.value.match(regexp)) {
            $('#urlcontent').html("<span class='text-success'>URL " + e.target.value + " is valid</span>");
            validUrl = e.target.value;
          }
          else {
            $('#urlcontent').html("<span class='text-danger'>URL " + e.target.value + " is not valid</span>");
          }
        });
        $('#phoneInput').on('input',function(e){
          $('#phonecontent').html("<span class='text-info'>validating... "+e.target.value+"</span>");
          if(e.target.value.match(phoneno)) {
            $('#phonecontent').html("<span class='text-success'>Phone number " + e.target.value + " is valid</span>");
            validPhone = e.target.value;
          }
          else {
            $('#phonecontent').html("<span class='text-danger'>Phone number " + e.target.value + " is not valid</span>");
          }
        });

        $('#saveLink').on('click',function(e){
          if(validUrl != ''){
            $('#linkurl').val(validUrl);
            $('#preview-link').text(validUrl);
          }
          if(validPhone != ''){
            $('#telephone').val(validPhone);
            $('#preview-phone').text(validPhone);
          }
          $("#linkModal").hide();
          $("#linkModal").modal('hide');
        });


        // $(function() {
        //   var forum = new Forum();
        //   console.log(forum);
        //   userID = 1;
        //   lastID = 5;
        //   searchToken = "";
        //   forum.refresh();
        //   $("#forum-form").submit(function(event) {
        //     event.preventDefault();
        //     var form = $.this;
        //     var formData = new FormData(form);
        //     forum.send(formData);
        //   });

        // });
      });
</script>
@endsection