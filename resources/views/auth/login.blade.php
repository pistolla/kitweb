@extends('layouts.fullpage')

@section('content')
<section class="contact-page-area full-page-background" id="Contact" style="min-height: 100vh; background: no-repeat center/150% url('{{ url('/images/logo/logo-background.jpg') }}')">
    <div class="container">
        <div class="row wow fadeInDown" data-wow-delay="2s" style="width:50%; margin: auto;">
            <div class="col-lg-12 col-md-4">
                    <div class="card">
                    <h2 class="card-title text-center" style="padding: 10px;">Advertiser Log In</h2>
                        <div class="card-body">
                            <form class="contact-form" method="POST" action="{{ route('login') }}" >
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        @include('layouts.error') 
                                        
                                        <div class="form-element margin-bottom-20">
                                            <input id="username" type="text" placeholder="Enter Username" class="input-field" name="username" value="{{ old('username') }}" required autofocus>
                                        </div>
                                        <div class="form-element margin-bottom-20">
                                            <input id="password" type="password" placeholder="Enter Password" class="input-field" name="password" required>
                                        </div>
                                        <div class="form-element mb-2">
                                        <a href="{{ route('password.resetreq') }}">Forgot Your Password? </a>
                                        </div>
                                        <div class="form-element margin-bottom-20 text-center d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Log In</button>
                                            <a class="float-left btn btn-lg" href="{{route('register')}}">Register</a>
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
