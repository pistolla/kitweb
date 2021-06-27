@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="title">{{$pt}}</h1>
                    <h4>Balance : <strong>{{round(Auth::user()->balance,$gnl->decimal)}} {{$gnl->cur}}</strong></h4> 
                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimonial-page-conent">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-testimonial-item">
                    <div class="img-wrapper">
                        <div class="icon big-dash-icon"><i class="fa fa-globe"></i></div>
                    </div>
                    <div class="content">
                        <h6>Total Impression</h6>
                        <h2>{{$impression}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-testimonial-item">
                    <div class="img-wrapper">
                        <div class="icon big-dash-icon"><i class="fa fa-hand-point-up"></i></div>
                    </div>
                    <div class="content">
                        <h6>Total Clicked</h6>
                        <h2>{{$click}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-testimonial-item">
                    <div class="img-wrapper">
                        <div class="icon big-dash-icon"><i class="fa fa-archive"></i></div>
                    </div>
                    <div class="content">
                        <h6>View Credit Remains</h6>
                        <h2>{{Auth::user()->credit}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-testimonial-item">
                    <div class="img-wrapper">
                        <div class="icon big-dash-icon"><i class="fa fa-wallet"></i></div>
                    </div>
                    <div class="content">
                        <h6>Click Credit Remains</h6>
                        <h2>{{Auth::user()->click}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Current Advertisements</div>
                    <div class="card-body">
                        
                        <div class="row">
                            @if(count($advs)==0)
                            <div class="col-md-12">
                                <h3 class="text-center">No Ads Available</h3> 
                            </div>
                            @endif
                            @foreach($advs as $ad)
                            <div class="col-md-4 mt-2">
                                <div class="card card-body text-center">
                                    <ul class="list-group">
                                        <li class="list-group-item"><img src="{{asset('/images/ads')}}/{{$ad->photo}}" alt="adImage" style="width:100%;"></li>
                                        <li class="list-group-item">{{$ad->adtype->name}}</li>
                                        <li class="list-group-item">Link: {{$ad->link}}</li>
                                        <li class="list-group-item">Type: <span class="badge {{$ad->click==1?'badge-success':'badge-info'}}">{{$ad->click==1?'Click':'Impression'}}</span></li>
                                        <li class="list-group-item">Estimated Amount: {{$ad->total}} {{$ad->click==1?'Click':'Impression'}}</li>
                                        <li class="list-group-item">Clicked: {{$ad->count_click}}</li>
                                        <li class="list-group-item">Impression: {{$ad->count_imp}}</li>
                                        <li class="list-group-item">Status: 
                                            <span class="badge {{$ad->status==1?'badge-secondary':'badge-danger'}}">
                                                {{$ad->status==1?'Active':'Deactive'}}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        {{$advs->links()}} 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



