@extends('layouts.user')

@section('content')
<section class="contact-page-area full-page-background"  style="min-height: 100vh; background: no-repeat center/150% url('{{ url('/images/logo/logo-background.jpg') }}')">
    <div class="container">
        <div class="row wow fadeInDown justify-content-center" data-wow-delay="2s" style="width:100%; margin: auto;">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="logo text-center">
                    <a href="{{ url('/')}}"><img src="{{asset('/images/logo/logo.png')}}" alt="logo" class="logo-default" style="max-width: 160px;"></a>
                  </div>
                    <div class="card border-0">
                                <h2 class="card-title text-center" style="padding: 60px;"> Reset Password Now</h2>
                        <div class="card-body">
                            <form class="contact-form" method="POST" action="{{ route('pub.password.resetpassword') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
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
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>