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
            <div class="col-md-4 col-sm-6">
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
            <div class="col-md-4 col-sm-6">
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
            <div class="col-md-4 col-sm-6">
                <div class="single-testimonial-item">
                    <div class="img-wrapper">
                        <div class="icon big-dash-icon"><i class="fa fa-wallet"></i></div>
                    </div>
                    <div class="content">
                        <h6>Earnings</h6>
                        <h2>{{round(Auth::guard('publisher')->user()->balance,$gnl->decimal)}} <span style="font-size:15px;">{{$gnl->cur}}</span></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <hr>
                <div class="card">
                    <div class="card-header text-center">
                        Withdraw Log
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Method</th>
                                    <th class="text-center">Account</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Trx Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($withds)==0) 
                                <tr>
                                    <td colspan="5"><h2>No Data Available</h2></td>
                                </tr>
                                @endif
                                @foreach($withds as $log)
                                <tr>
                                    <td>{{$log->amount}} {{$gnl->cur}}</td>
                                    <td>{{$log->wmethod->name}}</td>
                                    <td>{{$log->account}}</td>
                                    <td>
                                        <span class="badge @if($log->status==1) badge-success @elseif($log->status==2) badge-danger @else label-warning @endif">
                                            @if($log->status==1)Approved @elseif($log->status==2)Canceled @else Pending @endif 
                                        </span>
                                    </td>
                                    <td>{{$log->updated_at}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        {{$withds->links()}}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



