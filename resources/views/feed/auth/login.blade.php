@extends('layouts.fullpage')

@section('content')
<section id="Login full-page-background" style="background: no-repeat center/100% url('{{ url('/images/logo/logo-background.jpg') }}')">
    <div class="row cloud-drive">
            <div class="col-md-6 detail-container justify-height">
                <div class="layyer">
                        <div class="row header">
                                <div class="col-sm-4">
                                        <img src="{{ url('/images/logo/logo.png') }}" alt="logo">
                                </div>
                                <div class="col-sm-8 ">
                                        
                                </div>
                                
                                
                            </div>  
                            <div class="detail-text">
                                    <h1>Work safely, in the office or on the go, with complete peace of mind.</h1>
                                    <p>Cloud Drive provides comprehensive cybersecurity to backup data with secure passwords, and stop hackers. Get access to files anywhere through secure cloud storage and file backup for your photos, videos, files and more with Cloud Drive.</p>    
                            </div>     
                </div> 
            </div>
            <div class="col-md-6 col-sm-12 sign-up" style="height: 100vh;">
                <div class="row">
                    <ul>
                        <li onclick="showLogin()" id="login" class="sel">Sign In</li>
                    </ul>
                </div>
                <h3></h3>
                <div class="login">
                    <form class="contact-form" method="POST" action="{{ route('feed.loginpost') }}">
                    @csrf
                        <div class="row form-row">
                            @include('layouts.error')
                            <input placeholder="Enter Email Address" type="text" class="input-field" name="username" value="{{ old('username') }}" required autofocus>
                        </div>
                        <div class="row form-row">
                            <input type="text" placeholder="Enter Password" class="input-field" name="password" required>
                        </div>
                        <div class="row form-row">
                        <a class="float-right" href="{{ route('feed.password.resetreq') }}">
                                Forgot Your Password?
                            </a>
                            </div>
                        <div class="row form-row">
                            <button type="submit" class="btn btn-info btn-sm">Login</button>
                        </div>
                        <div class="row form-row">
                            <a href="{{route('feed.register')}}" class="btn btn-info btn-sm">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    
</section>

@endsection

