@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class="breadcrumb-inner">
            <h1 class="title">Featured</h1>
        </div>
        <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="970x250"></div>
    </div>
</section>
<div id="fb-root"></div>
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 my-2">
                <div class="fb-page" data-href="https://www.facebook.com/kissdeveloper-505672739950146/" data-width="800" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/kissdeveloper-505672739950146/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/kissdeveloper-505672739950146/">DevTime</a></blockquote></div>
            </div>
            <div class="col-md-6 my-2">
                <a class="twitter-follow-button"
                    href="https://twitter.com/TwitterDev"
                    data-size="large">
                    Follow @TwitterDev</a>
            </div>
        </div>
    </div>
</section>
<section class="blog-page-conent" id="advertiser">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title">
                    <h2 class="title">Advertisers</h2>
                </div>
            </div>
        </div>
        @foreach ($advertisers as $index => $feature)
            @if ($index % 2 === 0)
                <div class="row my-5 py-5">
                    <div class="col-md-6 text-center">
                        <img class=" img-fluid" src="{{ asset('images/slider') .'/' . $feature->photo }}" alt="placeholder" height="150">
                    </div>
                    <div class="col-md-6 p-2">
                        <span class="badge badge-success badge-pill p-2">{{$index+1}}</span>
                        <h2 class="text-info h2">{{$feature->heading}}</h2>
                        <p class="text-info h4">{{$feature->details}}</p>
                    </div>
                </div>    
            @else
            <div class="row my-5 py-5">
                <div class="col-md-6 p-2">
                    <span class="badge badge-success badge-pill p-2">{{$index+1}}</span>
                    <h2 class="text-info h2">{{$feature->heading}}</h2>
                    <p class="text-info h4">{{$feature->details}}</p>
                </div>
                <div class="col-md-6 text-center">
                    <img class=" img-fluid" src="{{ asset('images/slider') .'/' . $feature->photo }}" alt="placeholder" height="150">
                </div>
            </div>
            @endif
            <hr>
        @endforeach
    </div>
</section>
<section class="blog-page-conent" id="publisher">
    <div class="container">
    <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title">
                    <h2 class="title">Publisher</h2>
                </div>
            </div>
        </div>
        @foreach ($publishers as $index => $feature)
            @if ($index % 2 === 0)
                <div class="row my-5 py-5">
                    <div class="col-md-6 text-center">
                        <img class=" img-fluid" src="{{ asset('images/slider') .'/' . $feature->photo }}" alt="placeholder" height="150">
                    </div>
                    <div class="col-md-6 p-2">
                        <span class="badge badge-success badge-pill p-2">{{$index+1}}</span>
                        <h2 class="text-info h2">{{$feature->heading}}</h2>
                        <p class="text-info h4">{{$feature->details}}</p>
                    </div>
                </div>    
            @else
            <div class="row my-5 py-5">
                <div class="col-md-6 p-2">
                    <span class="badge badge-success badge-pill p-2">{{$index+1}}</span>
                    <h2 class="text-info h2">{{$feature->heading}}</h2>
                    <p class="text-info h4">{{$feature->details}}</p>
                </div>
                <div class="col-md-6 text-center">
                    <img class=" img-fluid" src="{{ asset('images/slider') .'/' . $feature->photo }}" alt="placeholder" height="150">
                </div>
            </div>
            @endif
            <hr>
        @endforeach
    </div>
</section>
@endsection
@section('page_scripts')

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0&appId=2133305486947477&autoLogAppEvents=1" nonce="Nw8GPnXI"></script>

<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>
@endsection