@extends('layouts.fullpage')

@section('content')
<section id="Register" class="full-page-background" style="background: no-repeat center/100% url('{{ url('/images/logo/logo-background.jpg') }}');">
<div class="row cloud-drive">
            <div class="col-md-6 detail-container justify-height">
                <div class="layyer">
                        <div class="row header">
                                <div class="col-sm-4">
                                        <img src="{{ url('/images/logo/logo.png') }}" alt="logo">
                                </div>
                                <div class="col-sm-8">
                                        
                                </div>
                                
                                
                            </div>  
                            <div class="detail-text">
                                    <h1>Work safely, in the office or on the go, with complete peace of mind.</h1>
                                    <p>Cloud Drive provides comprehensive cybersecurity to backup data with secure passwords, and stop hackers. Get access to files anywhere through secure cloud storage and file backup for your photos, videos, files and more with Cloud Drive.</p>    
                            </div>     
                </div>
            </div>
            <div class="col-md-6 col-sm-12 sign-up">
                <div class="row">
                    <ul>
                        <li onclick="showLogin()" id="login" class="sel">Sign In</li>
                    </ul>
                </div>
                <h3></h3>
                <div class="login">
                    <form class="contact-form" method="POST" action="{{ route('feed.registerpost') }}">
                    @csrf
                        <div class="row form-row">
                            @include('layouts.error')
                            <input class="input-field" id="name" type="text" placeholder="Enter Name" name="name" value="{{ old('name') }}" required autofocus>
                        </div>
                        <div class="row form-row">
                            <input class="input-field" id="email" type="email" placeholder="Enter Email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="row form-row">
                            <input class="input-field" id="username" type="text" placeholder="Enter Username" name="username" value="{{ old('username') }}" required>
                        </div>
                        <div class="row form-row">
                            <input class="input-field" id="country" type="text" placeholder="Enter Name of Country " name="country" value="{{ old('country') }}" required>
                        </div>
                        <div class="row form-row">
                            <input class="input-field" id="city" type="text" placeholder="Enter Name of City" name="city" value="{{ old('city') }}" required>
                        </div>
                        <div class="row form-row">
                            <input class="input-field" id="mobile" type="text" placeholder="Enter Mobile Number" name="mobile" value="{{ old('mobile') }}" required>
                        </div>
                        <div class="row form-row">
                            <input class="input-field" id="password" type="password" placeholder="Enter Password" name="password" required>
                        </div>
                        <div class="row form-row">
                            <input class="input-field" id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                        </div>
                        <div class="row form-row">
                            <button type="submit" class="btn btn-info btn-sm">Register</button>
                        </div>
                        <div class="row form-row">
                            <a href="{{route('feed.login')}}" class="btn btn-info btn-sm">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

