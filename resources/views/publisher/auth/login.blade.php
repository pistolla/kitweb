@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="title">Publisher Log In</h1>
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
                                            <h2 class="card-title text-center" style="padding: 60px;">Publisher Log In</h2>
                        <div class="card-body">
                            <form class="contact-form" method="POST" action="{{ route('publisher.loginpost') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 mx-auto">
                                        @include('layouts.error') 
                                        
                                        <div class="form-element margin-bottom-20">
                                            <input id="username" type="text" placeholder="Enter Username" class="input-field" name="username" value="{{ old('username') }}" required autofocus>
                                        </div>
                                        <div class="form-element margin-bottom-20">
                                            <input id="password" type="password" placeholder="Enter Password" class="input-field" name="password" required>
                                        </div>
                                        
                                        <div class="form-element margin-bottom-20 text-center">
                                            <button type="submit" class="submit-btn">Log In</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <a class="float-left btn btn-sm" href="{{route('publisher.register')}}">
                                Register
                            </a>
                            
                            <a class="float-right" href="{{ route('pub.password.resetreq') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

