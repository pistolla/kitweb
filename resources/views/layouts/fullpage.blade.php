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
</head>

<body> 
<div id="justify-height">
    @yield('content')
</div>  


<div class="copyright-area dark-blug-lg mt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <span class="copytext"> {{$gnl->title}} &copy; {{date('Y')}}  All Rights Reserved.</span>
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