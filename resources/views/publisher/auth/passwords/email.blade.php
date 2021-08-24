@extends('layouts.fullpage')

@section('content')
<section class="contact-page-area"   style="min-height: 100vh; background: no-repeat center/150% url('{{ url('/images/logo/logo-background.jpg') }}')">
    <div class="container">
        <div class="row wow fadeInDown" data-wow-delay="2s" style="width:80%; margin: auto;">
            <div class="col-lg-12">
                    <div class="card mt-5">
                         <h2 class="card-title text-center" style="padding: 60px;"> Forgot Password?</h2>
                        <div class="card-body">
                            <form class="contact-form"  method="POST" action="{{ route('pub.password.sendemail') }}">
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

