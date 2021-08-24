@extends('layouts.fullpage')

@section('content')
<section class="contact-page-area full-page-background" id="Contact" style="background: no-repeat center/150% url('{{ url('/images/logo/logo-background.jpg') }}')">
    <div class="container">
        <div class="row wow fadeInDown" data-wow-delay="2s" style="width:60%; margin: auto;">
            <div class="col-lg-12">
                    <div class="card mt-5">
                        <h2 class="card-title text-center" style="padding: 60px;"> Advertiser Registration</h2>
                        <div class="card-body">
                        @if($gnl->reg==1)
                            <form class="contact-form" method="POST" action="{{ route('register') }}">
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
                                        <select name="country" class="input-field form-control">
                                            <option value="">--- Select country ---</option>
                                            @foreach ($countries as $key => $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-element margin-bottom-20">
                                        <select name="city" class="input-field form-control">
                                            <option value="">--- Select city ---</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-element margin-bottom-20">
                                        <input type="hidden" id="codehidden" value="">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span id="code" class="input-group-text">+1</span>
                                            </div>
                                            <input class="input-field form-control" id="mobile" type="tel" placeholder="Enter Mobile Number" name="mobile" value="{{ old('mobile') }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field form-control" id="password" type="password" placeholder="Enter Password" name="password" required>
                                    </div>
                                    <div class="form-element margin-bottom-20">
                                        <input class="input-field form-control" id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                                    </div>
                                    <div class="form-element margin-bottom-20 text-center d-flex justify-content-end">
                                        <button type="submit" class="submit-btn">Register</button>
                                        <a class="btn btn-lg" href="{{route('login')}}">
                                            Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                        @else
                        <h1>Registration Closed NOw</h1>
                        @endif
                     </div>
                </div>
        </div>
    </div>
</div>
</section>

@endsection
