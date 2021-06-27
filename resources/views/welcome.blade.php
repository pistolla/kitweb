<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <title> {{ $gnl->title }} | {{ $gnl->subtitle }} </title>
    <link rel="shortcut icon" href="{{  asset('/images/logo/icon.png')  }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/responsive.css') }}">
    <link href="{{ asset('/css/color.php?color=') }}{{ $gnl->color }}" rel="stylesheet">
</head>

<body> 
    <!-- navbar area start -->
    <nav class="navbar navbar-area navbar-expand-lg navbar-light ">
        <div class="container nav-container">
            <div class="logo-wrapper navbar-brand">
                <a href="{{ url('/') }}" class="logo main-logo">
                    <img src="{{ asset('/images/logo/logo.png') }}" alt="logo" style="max-width:160px;">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="mirex">
                <!-- navbar collapse start -->
                <ul class="navbar-nav">
                    <!-- navbar- nav -->
                    <li class="nav-item active">
                        <a class="nav-link pl-0" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Service">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#About">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.blog') }}">Blog</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}/contact">Contact</a>
                    </li>
                </ul>
                <!-- /.navbar-nav -->
            </div>
            <div class="right-btn-wrapper">
                <a href="{{ route('login') }}" class="boxed-btn btn-rounded">Advertiser</a>
                <a href="{{  route('publisher.login')  }}"  class="boxed-btn btn-rounded">Publisher</a>
            </div>
            
            <div class="responsive-mobile-menu">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mirex" aria-controls="mirex"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</nav>

<div class="header-area header-bg">
<div class="sonar-wrapper">
                    <div class="sonar-emitter">
                        <div class="sonar-wave"></div>
                    </div>
                </div>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-12">
                <div class="header-inner ">
                    <h1 class="title">{{ $front->banner_heading }}</h1>
                    <p class="wow fadeInDown">{!! $front->banner_details !!}</p>
                    <div class="btn-wrapper">
                        <a href="{{ route('login') }}" class="boxed-btn btn-rounded">JOIN US</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!--Waves Start-->
    <div class="wave-wrapper">
<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
<defs>
<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
</defs>
<g class="parallax">
<use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
<use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
<use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
<use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
</g>
</svg>
</div>
<!--Waves end-->
</div>

<section class="service-area" id="Service">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title extra">
                    <h2 class="title">{{ $front->service_heading }}</h2>
                    <p>{!! $front->service_details !!}</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($sliders as $item)
            <div class="col-lg-6 col-md-6">
                <div class="single-service-item">
                    <div class="content">
                        <h4 class="title">{{ $item->heading }}</h4>
                        <p>{!! $item->details !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<section class="video-area grd-overlay" style="background-image: url({{ asset('images/frontend') }}/{{ $front->about_image }}); background-size: cover;background-position: center;" id="About">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="video-area-content">
                    <div class="video-ply-wrapper">
                        <a href="{{ $front->video }}" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
                    </div>
                    <h2 class="title">{{ $front->about_heading }}</h2>
                    <p>{!!$front->about_details!!}</p>
                    <div class="btn-wrapper">
                        <a href="{{ route('login') }}" class="boxed-btn btn-rounded">Join Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial-area " id="Testimonials">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content-area">
                    <h3 class="title">{{ $front->testimonial_heading }}</h3>
                    <p>{!! $front->testim_details !!}</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content-area">
                    <div class="testimonial-carousel" id="testimonial-carousel">
                        @foreach ($testimonials as $item)   
                        <div class="single-testimonial-carousel">
                            <div class="author-details">
                                <div class="pro-immage">
                                    <img src="{{  asset('images/testimonial')  }}/{{ $item->photo }}" alt="testimonial image">
                                </div>
                                <div class="content">
                                    <h4 class="title">{{ $item->name }}</h4>
                                    <span class="post">{{ $item->heading }}</span>
                                </div>
                            </div>
                            
                            <div class="description">
                                <p>{!! $item->details !!}</p>
                            </div>
                        </div>
                        @endforeach    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="achivement-area gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title">
                    <h2 class="title">{{ $front->stat_heading }}</h2>
                    <p>{!! $front->stat_details !!}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-achivement-item">
                    <div class="number">
                        <span class="num-count">{{ $front->stat1 }}</span>{{ $front->stat2 }}
                    </div>
                    <h4 class="title">{{ $front->stat3 }}</h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-achivement-item">
                    <div class="number">
                        <span class="num-count">{{ $front->stat4 }}</span>{{ $front->stat5 }}
                    </div>
                    <h4 class="title">{{ $front->stat6 }}</h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-achivement-item">
                    <div class="number">
                        <span class="num-count">{{ $front->stat7 }}</span>{{ $front->stat8 }}
                    </div>
                    <h4 class="title">{{ $front->stat9 }}</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title extra">
                    <h2 class="title">{{ $front->faq_heading }}</h2>
                    <p>{!! $front->faq_details !!}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content-wrapper">
                    <div id="accordion">
                        @foreach($faqs as $key => $faq)   
                        @if($key%2 != 0) 
                        <div class="card">
                            <div class="card-header" id="heading{{ $key }}">
                                <a  data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">
                                    {{ $faq->heading }}
                                </a>
                            </div>
                            
                            <div id="collapse{{ $key }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    {!!$faq->details!!}
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach 
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content-wrapper">
                    <div id="accordion_2">
                        @foreach($faqs as $key => $faq)   
                        @if($key%2 == 0)     
                        <div class="card">
                            <div class="card-header" id="heading{{ $key }}_2">
                                <a  data-toggle="collapse" data-target="#collapse{{ $key }}_2" aria-expanded="false" aria-controls="collapse{{ $key }}_2">
                                    {{ $faq->heading }}
                                </a>
                            </div>
                            <div id="collapse{{ $key }}_2" class="collapse" aria-labelledby="heading{{ $key }}_2" data-parent="#accordion_2">
                                <div class="card-body">
                                    {!!$faq->details!!}
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach 
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <div class="btn-wrapper">
                    <a href="{{ url('/') }}/contact" class="boxed-btn btn-rounded">Any question?</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- faq area end -->

<section class="marketing-area gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="marekting-inner">
                    <h2 class="title">Subscribe Us</h2>
                    <div class="subscribe-form-wapper">
                        <form id="subscribeForm" class="subscribe-form">
                            @csrf 
                            <div class="form-element">
                                <input type="email" name="email" class="input-field" placeholder="Enter your email...">
                            </div>
                            <input type="submit" class="submit-btn" value="Subscribe now">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- footer area start -->
<section class="footer-area blue-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="footer-widget about"><!-- footer widget -->
                    <div class="widget-body">
                        <a href="{{ url('/') }}" class="footer-logo">
                            <img src="{{ asset('images/logo/logo.png') }}" style="max-width:180px;" alt="footer logo">
                        </a>
                        <p>{!! $front->footer !!}</p>
                            
                    </div>
                </div><!-- //.footer widget -->
            </div>
            <div class="col-lg-2">
                <div class="footer-widget"><!-- footer widget -->
                    <div class="widget-title">
                        <h4 class="title">Links</h4>
                    </div>
                    <div class="widget-body">
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="#Service">Service</a></li>
                            <li><a href="#About">About</a></li>
                            <li><a href="#Testimonials">Testimonials</a></li>
                            <li><a href="{{ url('/') }}#Contact">Contact</a> </li>
                        </ul>
                    </div>
                </div><!-- //.footer widget -->
            </div>
            
            <div class="col-lg-3">
                <div class="footer-widget contact">
                    <div class="widget-title">
                        <h4 class="title">Latest Posts</h4>
                    </div>
                    <div class="widget-body">
                        <ul>
                            @foreach ($posts as $item)
                            <li><a href="{{ route('user.blog-post', $item->id) }}"> <img src="{{  asset('images/blog')  }}/{{ $item->photo }}" style="max-width:40px;" alt="blog images">
                               {{ substr($item->heading, 0,50) }}</a> </li>
                            @endforeach  
                        </ul>
                    </div>                   
                </div>
            </div>
            <div class="col-lg-3">
                <div class="footer-widget contact"><!-- footer widget -->
                    <div class="widget-title">
                        <h4 class="title">Contact Us</h4>
                    </div>
                    <div class="widget-body">
                        <ul>
                            <li>  <i class="fa fa-envelope"></i> {{ $front->contact_email }}</li>
                            <li><i class="fa fa-phone"></i> {{ $front->contact_number }}</li>
                            <li><i class="fa fa-map"></i> {!! $front->contact_address !!}</li>
                        </ul>
                        <ul class="social-icons">
                                @foreach($socials as $social)
                                <li class="facebook"><a href="{{ $social->link }}" target="_blank"><i class="fab fa-{{ $social->icon }}"></i></a></li>
                                @endforeach
                            </ul>    
                    </div>                   
                </div><!-- //.footer widget -->
            </div>
        </div>
    </div>
</section>
<div class="copyright-area dark-blug-lg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <span class="copytext"> {{ $gnl->title }} &copy; {{ date('Y') }}. All Rights Reserved.</span>
            </div>
        </div>
    </div>
</div>
<!-- footer area end -->

<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="preloader-container">
            <div class="item item-1"></div>
            <div class="item item-2"></div>
            <div class="item item-3"></div>
            <div class="item item-4"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->


<!-- back to top start -->
<div class="back-to-top">
    <i class="fas fa-rocket"></i>
</div>
<!-- back to top end -->

<!-- jquery -->
<script src="{{ asset('js/jquery.js') }}"></script>
<!-- popper -->
<script src="{{ asset('js/popper.min.js') }}"></script>    
<!-- bootstrap -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- way poin js-->
<script src="{{ asset('js/waypoints.min.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<!-- magnific popup -->
<script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
<!-- wow js-->
<script src="{{ asset('js/wow.min.js') }}"></script>
<!-- counterup js-->
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<!-- main -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js')  }}"></script>
<script>
    $(document).ready(function(){ 
        $(window).on('load',function(){
            /*-----------------
                preloader
            ------------------*/
            var preLoder = $("#preloader");
            preLoder.fadeOut(1000);
            /*-----------------
                back to top
            ------------------*/
            var backtoTop = $('.back-to-top')
            backtoTop.fadeOut(100);
        }); 
        $(document).on('submit','#subscribeForm',function(event)
        {
            event.preventDefault();
            $.ajax({
                type:"POST",
                url:"{{ route('subscriber') }}",       
                data: new FormData(document.getElementById('subscribeForm')),
                contentType: false,
                processData: false,
                success:function(data)
                {
                    if(data==200)
                    {
                        swal("Success!", "Message Sent Successfully", "success");
                    }
                    else if(data==11)
                    {
                        swal("Sorry!", "Email Already Subscribed", "error");
                    }
                    else if(data==22)
                    {
                        swal("Sorry!", "Email Can Not Be Empty", "error");
                    }
                    else
                    {
                        swal("Sorry!", "An Error Occured", "error");
                    }
                }
            });
        });
    });
</script>  
</body>

</html>