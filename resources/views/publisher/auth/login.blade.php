@extends('layouts.fullpage')

@section('content')
<section class="contact-page-area full-page-background" id="Contact" style="background: no-repeat center/150% url('{{ url('/images/logo/logo-background.jpg') }}')">
    <div class="container contact-page-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-page-inner">
                    <div class="card">
                        <h2 class="card-title text-center" style="padding: 10px;">Publisher Log In</h2>
                        <div class="card-body">
                            <form class="contact-form" method="POST" action="{{ route('publisher.loginpost') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mx-auto">
                                        @include('layouts.error') 
                                        
                                        <div class="form-element margin-bottom-20">
                                            <input id="username" type="text" placeholder="Enter Username" class="input-field" name="username" value="{{ old('username') }}" required autofocus>
                                        </div>
                                        <div class="form-element margin-bottom-20">
                                            <input id="password" type="password" placeholder="Enter Password" class="input-field" name="password" required>
                                        </div>
                                        <div class="form-element margin-bottom-20 mb-2">
                                            <a class="float-right" href="{{ route('pub.password.resetreq') }}">
                                                Forgot Your Password?
                                            </a>
                                        </div>
                                        <div class="form-element margin-bottom-20 text-center d-flex justify-content-center">
                                            <button type="submit" class="submit-btn">Log In</button>
                                            <a class="float-left btn btn-lg" href="{{route('publisher.register')}}">
                                                Register
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

