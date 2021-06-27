@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="title">Password Reset</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-page-area" id="Contact">
    <div class="container contact-page-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-page-inner">
                    <div class="card">
                                                 <h2 class="card-title text-center" style="padding: 60px;"> Reset Password Now</h2>
                        <div class="card-body">
                            <form class="contact-form" method="POST" action="{{ route('password.resetpassword') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-8 mx-auto">
                                    <input type="hidden" value="{{$token}}" name="token" />
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field" id="email" type="text" value="{{ $username }}" readonly />
                                    </div>
                                    
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field" id="password" type="password" placeholder="Enter New Password" name="password" required>
                                    </div>
                                    
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field" id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                                    </div>
                                    <div class="form-element margin-bottom-20 text-center">
                                        <button type="submit" class="submit-btn">
                                            Reset Password
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    
    @endsection
    