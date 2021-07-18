@extends('layouts.fullpage')

@section('content')
<section class="contact-page-area full-page-background" id="Contact" style="background: no-repeat center/150% url('{{ url('/images/logo/logo-background.jpg') }}')">
    <div class="container contact-page-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-page-inner">
                    <div class="card">
                        <h2 class="card-title text-center" style="padding: 60px;"> Register as Publisher</h2>
                        <div class="card-body">
                        @if($gnl->reg==1)
                            <form class="contact-form" method="POST" action="{{ route('publisher.registerpost') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-8 mx-auto">
                                    
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field" id="name" type="text" placeholder="Enter Name" name="name" value="{{ old('name') }}" required autofocus>
                                    </div>
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field" id="email" type="email" placeholder="Enter Email" name="email" value="{{ old('email') }}" required>
                                    </div>
                                    
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field" id="username" type="text" placeholder="Enter Username" name="username" value="{{ old('username') }}" required>
                                    </div>
                                    
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field" id="country" type="text" placeholder="Enter Name of Country " name="country" value="{{ old('country') }}" required>
                                    </div>
                                    
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field" id="city" type="text" placeholder="Enter Name of City" name="city" value="{{ old('city') }}" required>
                                    </div>
                                    
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field" id="mobile" type="text" placeholder="Enter Mobile Number" name="mobile" value="{{ old('mobile') }}" required>
                                    </div>
                                    
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field" id="password" type="password" placeholder="Enter Password" name="password" required>
                                    </div>
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field" id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                                    </div>
                                    <div class="mb-2">
                                        <a class="float-right" href="{{ route('pub.password.resetreq') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                    <div class="form-element margin-bottom-20 text-center d-flex justify-content-center">
                                        <button type="submit" class="submit-btn">Register</button>
                                        <a class="btn btn-lg" href="{{route('publisher.login')}}">
                                            Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                        @else
                        <h1>Regitsration Closed NOw</h1>
                        @endif
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection

