@extends('layouts.fullpage')

@section('content')
<section class="contact-page-area" style="min-height: 100vh; background: url('{{ url('/images/logo/logo-background.jpg') }}') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <div class="container">
        <div class="row wow fadeInDown justify-content-center" data-wow-delay="2s" style="width:100%; margin: auto;">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="logo text-center">
                    <a href="{{ url('/')}}"><img src="{{asset('/images/logo/logo.png')}}" alt="logo" class="logo-default" style="max-width: 160px;"></a>
                  </div>
                    <div class="card mt-5 border-0">
                        <h2 class="card-title text-center" style="padding: 10px;"> Forgot Password?</h2>
                        <div class="card-body">
                            <form class="contact-form" method="POST" action="{{ route('password.sendemail') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 mx-auto">
                                        <div class="form-element margin-bottom-20">
                                            <input id="email" class="input-field" type="email" placeholder="Enter Email" name="email" value="{{ old('email') }}" required>
                                        </div>
                                        <div class="form-element margin-bottom-20 text-center">
                                            <button type="submit" class="submit-btn">
                                                Send Reset Link
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

@endsection
