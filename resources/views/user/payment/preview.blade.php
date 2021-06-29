@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner">
                        <h1 class="title">{{$pt}}</h1> 
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="testimonial-page-conent">
        <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form  class="contact-form" method="POST" action="{{ route('deposit.confirm') }}">
                    @csrf
                    <input type="hidden" name="gateway" value="{{$data->gateway_id}}"/>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="list-group text-center">
                                <li class="list-group-item"><img src="{{asset('/images/gateway')}}/{{$data->gateway_id}}.jpg" style="max-width:100px; max-height:100px; margin:0 auto;"/></li>
                                <li class="list-group-item">Amount: <strong>{{$data->amount}} {{$gnl->cur}}</strong></li>
                                <li class="list-group-item">Charge: <strong>{{$data->charge}} {{$gnl->cur}}</strong></li>
                                <li class="list-group-item">Payable: <strong>{{$data->charge + $data->amount}} {{$gnl->cur}}</strong></li>
                                <li class="list-group-item">In USD: <strong>${{$data->usd_amo}}</strong></li>
                            </ul>
                        </div>
                        <div class="panel-footer">
                            <button type="submit" class="submit-btn" style="width:100%;">
                                Pay Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
