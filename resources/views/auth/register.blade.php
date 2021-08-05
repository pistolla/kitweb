@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class="row wow fadeInDown" data-wow-delay="2s" style="width:50%; margin: auto;">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="title">Advertiser Registration</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-page-area" id="Contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                    <div class="card">
                                                 <h2 class="card-title text-center" style="padding: 60px;"> Register as Advertiser</h2>
                        <div class="card-body">
                                @if($gnl->reg==1)
                            <form class="contact-form" method="POST" action="{{ route('register') }}" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="form-element margin-bottom-20">
                                            <input class="input-field form-control" id="name" type="text" placeholder="Enter Name" name="name" value="{{ old('name') }}" required autofocus>
                                        </div>
                                        <div class="form-element margin-bottom-20">
                                            <input class="input-field form-control" id="email" type="email" placeholder="Enter Email" name="email" value="{{ old('email') }}" required>
                                        </div>
                                        
                                        <div class="form-element margin-bottom-20">
                                            <input class="input-field form-control" id="username" type="text" placeholder="Enter Username" name="username" value="{{ old('username') }}" required>
                                        </div>
                                        
                                        <div class="form-element margin-bottom-20">
                                            <input class="input-field form-control" id="country" type="text" placeholder="Enter Name of Country " name="country" value="{{ old('country') }}" required>
                                        </div>
                                        
                                        <div class="form-element margin-bottom-20">
                                            <input class="input-field form-control" id="city" type="text" placeholder="Enter Name of City" name="city" value="{{ old('city') }}" required>
                                        </div>
                                        
                                        <div class="form-element margin-bottom-20">
                                            <input class="input-field form-control" id="mobile" type="text" placeholder="Enter Mobile Number" name="mobile" value="{{ old('mobile') }}" required>
                                        </div>
                                        
                                        <div class="form-element margin-bottom-20">
                                            <input class="input-field form-control" id="password" type="password" placeholder="Enter Password" name="password" required>
                                        </div>
                                        <div class="form-element margin-bottom-20">
                                            <input class="input-field form-control" id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                                        </div>
                                        
                                        <div class="form-element text-center margin-bottom-20">
                                            <button type="submit" class="submit-btn">Register</button>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </form>
                            @else
                            <h1>Registration Closed Now</h1>
                            @endif
                        </div>
                        <div class="card-footer">
                            <a class="float-left btn btn-sm" href="{{route('login')}}">
                                Log In
                            </a>
                            
                            <a class="float-right" href="{{ route('password.resetreq') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>

@endsection
