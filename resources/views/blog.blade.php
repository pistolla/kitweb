@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="970x250"></div> <script class="adScriptClass" src="http://localhost//ads/ad.js"></script>
    </div>
</section>
<div class="blog-page-conent">
    <div class="container">
        <div class="row">
            @foreach ($posts as $item)
            <div class="col-md-4 mt-5">
                <a href="{{route('user.blog-post', $item->id)}}">
                <div class="single-blog-post">
                    <div class="thumb">
                        <img src="{{ asset('/images/blog') }}/{{$item->photo}}" style="width:100%;" alt="blog images">
                    </div>
                    <div class="content">
                        <h4 class="title">{{$item->heading}}</h4>
                        <div class="post-meta">
                            <span class="time"><i class="far fa-clock"></i> {{$item->created_at->diffForHumans()}}</span>
                        </div>
                        <p>{{substr(strip_tags($item->details), 0, 100)}} <i class="fa fa-ellipsis-h"></i></p>
                        <a href="{{route('user.blog-post', $item->id)}}" class="readmore">Read More</a>
                    </div>
                </div>
                </a>
            </div>
            @endforeach  
        </div>
        <div class="row">
            <div class="col-md-12">
                {{$posts->links()}}
            </div>
        </div>
    </div>
</div>
@endsection