@extends('layouts.fullpage')

@section('content')
<section class="contact-page-area" id="contact-section" style="min-height: 100vh; background: url('{{ url('/images/logo/logo-background.jpg') }}') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <div class="container">
    <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="title">Publisher Verification</h1>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-md-12"> 
                <div class="left-content-area">
                    
                    @if(Auth::guard('publisher')->user()->status!=1)
                    <div class="section-title text-center">
                        <h2 class="title">Account Deactivated</h2>
                        <div class="separator"></div>
                    </div>
                    @elseif(Auth::guard('publisher')->user()->emailv!=1)
                    
                    <div class="section-title text-center">
                        <h2 class="title">Email Verification</h2>
                        <div class="separator"></div>
                        @include('layouts.error')
                    </div>
                    <div class="contact-form-wrapper">
                        <form class="row contact-form" method="POST" action="{{ route('publisher.send-vcode') }}">
                            @csrf
                            <div class="col-md-8 mx-auto">
                                <input id="email" type="hidden"  name="email" value="{{Auth::guard('publisher')->user()->email}}">
                                <h4 class="text-center">Your Email:<strong> {{Auth::guard('publisher')->user()->email}}</strong> </h4>
                                
                                <div class="col-md-12 text-center">
                                    <button style="background-color:#006699;" type="submit" class="submit-btn margin-bottom-20">Send Verification Code</button>
                                </div>
                            </div>
                        </form>
                        <hr/>
                        <form class="row contact-form" method="POST" action="{{ route('publisher.email-verify') }}">
                            @csrf
                            <div class="col-md-8 mx-auto">
                                @include('layouts.error') 
                                <div class="col-md-12">
                                    <div class="form-element margin-bottom-20">
                                        <input name="code" class="input-field" type="text" placeholder="Enter Verification Code"  required autofocus>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="submit-btn margin-bottom-20">Submit</button>
                                </div>
                            </div>
                        </form>
                        
                        @elseif(Auth::guard('publisher')->user()->smsv!=1)
                        
                        <div class="section-title text-center">
                            <h2 class="title">Mobile Number Verification</h2>
                            <div class="separator"></div>
                            @include('layouts.error')
                        </div>
                        <div class="contact-form-wrapper">
                            <form class="row contact-form" method="POST" action="{{ route('publisher.send-vcode') }}">
                                @csrf
                                <div class="col-md-8 mx-auto">
                                    <input type="hidden"  name="mobile" value="{{Auth::guard('publisher')->user()->email}}">
                                    <h4 class="text-center">Your Mobile No:<strong> {{Auth::guard('publisher')->user()->mobile}}</strong> </h4>
                                    
                                    <div class="col-md-12 text-center">
                                        <button style="background-color:#006699;" type="submit" class="submit-btn margin-bottom-20">Send Verification Code</button>
                                    </div>
                                </div>
                            </form>
                            <hr/>
                            <form class="row contact-form" method="POST" action="{{ route('publisher.sms-verify') }}">
                                @csrf
                                <div class="col-md-8 mx-auto">
                                    @include('layouts.error') 
                                    <div class="col-md-12">
                                        <div class="form-element margin-bottom-20">
                                            <input name="code" class="input-field" type="text" placeholder="Enter Verification Code"  required autofocus>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="submit-btn margin-bottom-20">Submit</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @endsection
