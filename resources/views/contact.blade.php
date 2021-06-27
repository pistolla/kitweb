@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="title">Contact</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-page-area margin-bottom-20">
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
