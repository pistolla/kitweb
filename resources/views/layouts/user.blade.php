<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! Meta::toHtml() !!}
    <title> {{$gnl->title}} | {{$gnl->subtitle}} </title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{asset('/images/logo/icon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('/css/responsive.css')}}">
    <link href="{{asset('/css/color.php?color=')}}{{$gnl->color}}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EQRHM67XW4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-EQRHM67XW4');
    </script>
</head>

<body>

    <nav class="navbar navbar-area navbar-expand-lg navbar-light ">
        <div class="container-fluid nav-container">
            <div class="logo-wrapper navbar-brand">
                <a href="{{url('/')}}" class="logo main-logo">
                    <img src="{{asset('/images/logo/logo.png')}}" alt="logo" style="max-width:160px;">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="mirex">
                <ul class="navbar-nav">

                    @if(Auth::guard('publisher')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('publisher.dashboard') }}"> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('publisher.getads') }}">Advertisements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('publisher.withdraw') }}">Withdraw</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{Auth::guard('publisher')->user()->name}} <span class="caret"></span></a>
                        <div class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <a class="dropdown-item" href="{{route('publisher.profile-data')}}">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                Logout </a>
                            <form id="logout-form" action="{{ route('publisher.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endif

                    @if(Auth::guard('web')->check() && !Auth::guard('publisher')->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}"> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.transactions') }}"> Transaction Log</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.plans') }}"> Plans</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.ads') }}"> Advertisements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.balance') }}"> Deposit</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}} <span class="caret"></span></a>
                        <div class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <a class="dropdown-item" href="{{route('user.profile-data')}}">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                Logout </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endif
                    @if(!Auth::check() && !Auth::guard('publisher')->check() )
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}#Service">SERVICE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}#Featured">FEATURED</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.blog')}}">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('feed.dashboard') }}">CLASSIFIED ADS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contact')}}">ABOUT</a>
                    </li>
                    @endif
                    @if(Auth::guard('feed')->check())
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{Auth::guard('feed')->user()->name}} <span class="caret"></span></a>
                        <div class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <a class="dropdown-item" href="{{route('feed.profile-data')}}">Profile</a>
                            <a class="dropdown-item" href="{{ route('feed.logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                Logout </a>
                            <form id="logout-form" action="{{ route('feed.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
            @if(!Auth::check())
            <div class="right-btn-wrapper d-flex">
                <a href="{{ route('login') }}" class="border-animation"><span class="border-animation__inner">Advertiser</span></a>
                <a href="{{  route('publisher.login')  }}" class="border-animation"><span class="border-animation__inner">Publisher</span></a>
            </div>
            @endauth
            <div class="responsive-mobile-menu">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mirex" aria-controls="mirex" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </nav>

    <div id="justify-height" style="min-height: 100vh">
        @yield('content')
    </div>


    <div class="copyright-area dark-blug-lg mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <span class="copytext"> &copy;{{ date('Y')}} {{ $gnl->title }}. All Rights Reserved.</span>

                    <ul class="list-inline m-1">
                        <li class="list-inline-item px-2"><a href="{{ url('/cookie-policy')}}">Cookie Policy</a></li>
                        <li class="list-inline-item px-2 "><a href="{{ url('/privacy-policy')}}">Privacy policy</a></li>
                        <li class="list-inline-item px-2"><a href="{{ url('/term-of-service')}}">Term of Service</a></li>
                        <li class="list-inline-item px-2"><a href="{{ url('/refund-policy')}}">Refund policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- back to top start -->
    <div class="back-to-top">
        <i class="fas fa-rocket"></i>
    </div>
    <!-- back to top end -->
    <script class="adScriptClass" type="text/javascript" src="{{asset('/ads/ad.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/jquery-3.2.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <!-- counterup js-->
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var winheight = $(window).height() - 71;
            $('#justify-height').css('min-height', winheight + 'px');
        });
    </script>
    <script>
        $(document).ready(function() {
            $(window).on('load', function() {
                /*-----------------
                    back to top
                ------------------*/
                var backtoTop = $('.back-to-top')
                backtoTop.fadeOut(100);
            });
        });
    </script>
    @include('layouts.sweet')
    @yield('page_scripts')
</body>

</html>