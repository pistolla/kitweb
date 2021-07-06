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
<section class="contact-page-area">
    <div class="container contact-page-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-page-inner">
                    <div class="card">
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
</div>
</section>

