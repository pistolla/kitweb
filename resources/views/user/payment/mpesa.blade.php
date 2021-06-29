@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="title">Mpesa Paybill</h1> 
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="testimonial-page-conent">
        <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form  class="contact-form" method="POST" action="{{ route('deposit.mpesa') }}">
                    @csrf
                    <input type="hidden" name="gateway" value="{{$data->gateway_id}}"/>
                    <div class="panel panel-default">
                        <div class="panel-body p-5">
                            <div class="card-body d-flex">
                                <div class="media-body">
                                    <img src="{{asset('/images/gateway')}}/{{$data->gateway_id}}.jpg" style="max-width:200px; max-height:200px; margin:0 auto;"/>
                                </div>
                                <div>
                                    <ul class="list-group text-center">
                                        <li class="list-group-item borderless">PAYBILL: <strong>{{ $data->paybill }}</strong></li>
                                        <li class="list-group-item borderless">ACCOUNT: <strong>{{ $data->account }}</strong></li>
                                        <li class="list-group-item borderless">AMOUNT: <strong>{{ $data->amount }}</strong></li>
                                    </ul>
                                    <button type="submit" class="submit-btn" style="width:100%;">
                                        PAY NOW
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
 