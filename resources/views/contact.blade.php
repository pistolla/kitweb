@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="title">About Us</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-page-area margin-bottom-20" id="about">
    <div class="container contact-page-container">
        <div class="row">
            <div class="col-lg-12 text-body">
                <div class="section-title">
                    <h2 class="title">Who are we</h2>
                </div>
                <div class="contact-page-inner">
                    <p>{!! $front->about_company !!}</p>
                    <address>
                        {{$front->banner_heading}}<br>
                        <a href="mailto:{{$front->contact_email}}">{{$front->contact_email}}</a><br>
                        <a href="tel:{{$front->contact_number}}">{{$front->contact_number}}</a><br>
                        {{$front->contact_address}}<br>
                    </address>
                </div><!-- //.contact page inner -->
            </div>
        </div>
    </div>
</section>
<section class="contact-page-area margin-bottom-20" id="contact">
    <div class="container contact-page-container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="section-title">
                    <h2 class="title">Contact With Us</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-page-inner">
                    <form  id="contactForm" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-element margin-bottom-30">
                                    <label for="name" class="label">Name *</label>
                                    <input type="text" name="name" class="input-field" placeholder="Enter your name">
                                </div>
                                <div class="form-element margin-bottom-30">
                                    <label for="phone" class="label">Phone</label>
                                    <input type="text" name="phone" class="input-field" placeholder="Enter phone number">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-element margin-bottom-30">
                                    <label for="email" class="label">Email *</label>
                                    <input type="email" name="email" class="input-field" placeholder="Enter your email">
                                </div>
                                <div class="form-element margin-bottom-30">
                                    <label for="subject" class="label">Subject *</label>
                                    <input type="text" name="subject" class="input-field" placeholder="Enter your subject">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-element textarea margin-bottom-30">
                                    <label for="message" class="label">Message *</label>
                                    <textarea name="message" placeholder="Enter message" class="input-field textarea" cols="30" rows="10"></textarea>
                                </div>
                                <input type="submit" class="submit-btn" value="Send Message">
                            </div>
                        </div>
                    </form>
                </div><!-- //.contact page inner -->
            </div>
        </div>
    </div>
</section>
<section class="faq-area" id="faqs">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title extra">
                    <h2 class="title">{{ $front->faq_heading }}</h2>
                    <p>{!! $front->faq_details !!}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content-wrapper">
                    <div id="accordion">
                        @foreach($faqs as $key => $faq)   
                        @if($key%2 != 0) 
                        <div class="card">
                            <div class="card-header" id="heading{{ $key }}">
                                <a  data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">
                                    {{ $faq->heading }}
                                </a>
                            </div>
                            
                            <div id="collapse{{ $key }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    {!!$faq->details!!}
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach 
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content-wrapper">
                    <div id="accordion_2">
                        @foreach($faqs as $key => $faq)   
                        @if($key%2 == 0)     
                        <div class="card">
                            <div class="card-header" id="heading{{ $key }}_2">
                                <a  data-toggle="collapse" data-target="#collapse{{ $key }}_2" aria-expanded="false" aria-controls="collapse{{ $key }}_2">
                                    {{ $faq->heading }}
                                </a>
                            </div>
                            <div id="collapse{{ $key }}_2" class="collapse" aria-labelledby="heading{{ $key }}_2" data-parent="#accordion_2">
                                <div class="card-body">
                                    {!!$faq->details!!}
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach 
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <div class="btn-wrapper">
                    <a href="#contact" class="boxed-btn btn-rounded">Any question?</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- faq area end -->

@endsection
@section('page_scripts')
<script>
    $(document).ready(function(){  
        $(document).on('submit','#contactForm',function(event)
        {
            event.preventDefault();
            $.ajax({
                type:"POST",
                url:"{{route('contact.message')}}",       
                data: new FormData(document.getElementById('contactForm')),
                contentType: false,
                processData: false,
                success:function(data)
                {
                    if(data==200)
                    {
                        swal("Success!", "Message Sent Successfully", "success");
                    }
                    else if(data==11)
                    {
                        swal("Sorry!", "Email Can not be Empty", "error");
                    }
                    else if(data==22)
                    {
                        swal("Sorry!", "Name Can not be Empty", "error");
                    }
                    else if(data==33)
                    {
                        swal("Sorry!", "Subject Field is Required", "error");
                    }
                    else if(data==44)
                    {
                        swal("Sorry!", "Message Can not be Empty", "error");
                    }
                    else
                    {
                        swal("Sorry!", "An Error Occured", "error");
                    }
                }
            });
        });
    });
</script> 
@endsection
