@extends('layouts.fullpage')

@section('content')
<section class="contact-page-area full-page-background" id="Contact" style="min-height: 100vh; background: url('{{ url('/images/logo/logo-background.jpg') }}') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <div class="container">
        <div class="row wow fadeInDown justify-content-center" data-wow-delay="2s" style="width:100%; margin: auto;">
            <div class="col-sm-12 col-md-10 col-lg-10">
                <div class="logo text-center">
                    <a href="{{ url('/')}}"><img src="{{asset('/images/logo/logo.png')}}" alt="logo" class="logo-default" style="max-width: 160px;"></a>
                  </div>
                    <div class="card mb-5 border-0">
                    <h2 class="card-title text-center" style="padding: 10px;">Members only Log In</h2>
                        <div class="card-body">
                            <form class="contact-form" method="POST" action="{{ route('feed.loginpost') }}" >
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 text-center border-right px-3 mb-2">
                                        <div class="header h6 mb-5">
                                            Login using your Social media account
                                        </div>
                                        <a href="{{url('/login/facebook')}}" class="btn btn-lg btn-social btn-facebook mb-2">
                                            <i class="fab fa-facebook-f"></i>
                                            Login with Facebook
                                        </a>
                                        <a href="{{url('/login/google')}}" class="btn btn-lg btn-social btn-google mb2">
                                            <span class="fab fa-google"></span>
                                            Login with Google
                                        </a>
<br><br>
                                        <div><small>By creating this account, you agree to our <a href="{{ route('user.privacy') }}">Privacy Policy</a> & <a href="{{ route('user.cookie') }}">Cookie Policy</a>.</small></div>
                                    </div>
                                    <div class="col-sm-12 col-md-8 px-4">
                                        @include('layouts.error') 
                                        
                                        <div class="form-element margin-bottom-20">
                                            <input id="username" type="text" placeholder="Enter Username" class="input-field form-control" name="username" value="{{ old('username') }}" required autofocus>
                                        </div>
                                        <div class="form-element margin-bottom-20">
                                            <input id="password" type="password" placeholder="Enter Password" class="input-field form-control" name="password" required>
                                        </div>
                                        <div class="form-element mb-2">
                                        <a href="{{ route('feed.password.resetreq') }}">Forgot Your Password? </a>
                                        </div>
                                        <div class="form-element margin-bottom-20 text-center d-flex justify-content-end">
                                            <button type="submit" class="btn submit-btn">Log In</button>
                                            <a class="float-left btn btn-lg" href="{{route('feed.register')}}">Register</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
