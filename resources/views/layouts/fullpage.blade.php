<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{$gnl->title}} | {{$gnl->subtitle}} </title>
    <link rel="shortcut icon" href="{{asset('/images/logo/icon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('/css/responsive.css')}}">
    <link href="{{asset('/css/color.php?color=')}}{{$gnl->color}}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-EQRHM67XW4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-EQRHM67XW4');
</script>
</head>

<body> 
<div id="justify-height">
    @yield('content')
</div>  


<div class="copyright-area dark-blug-lg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <span class="copytext"> &copy;{{ date('Y')}} {{ $gnl->title }}. All Rights Reserved.</span>

                    <ul class="list-inline my-1">
                        <li class="list-inline-item px-2"><a href="{{ url('/cookie-policy')}}">Cookie Policy</a></li>
                        <li class="list-inline-item px-2 "><a href="{{ url('/privacy-policy')}}">Privacy policy</a></li>
                        <li class="list-inline-item px-2"><a href="{{ url('/term-of-service')}}">Term of Service</a></li>
                        <li class="list-inline-item px-2"><a href="{{ url('/refund-policy')}}">Refund policy</a></li>
                    </ul>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('/js/jquery.js')}}"></script>
<script src="{{asset('/js/popper.min.js')}}"></script>    
<script src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/sweetalert.min.js') }}"></script>
<script src="{{asset('/js/main.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script>
    $(document).ready(function(){
        var winheight = $(window).height() -71;
        $('#justify-height').css('min-height',winheight+'px');
    });
</script>
@include('layouts.sweet')
@yield('page_scripts')
</body>

</html>