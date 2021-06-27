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
<div class="testimonial-page-conent">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Balance</th>
                            <th class="text-center">Details</th>
                            <th class="text-center">Trx ID</th>
                            <th class="text-center">Trx Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($logs)==0) 
                        <tr>
                            <td colspan="5"><h2>No Data Available</h2></td>
                        </tr>
                        @endif
                        @foreach($logs as $log)
                        <tr class="{{$log->type==1?'text-success':'text-danger'}}">
                            <td>{{$log->amount}} {{$gnl->cur}}</td>
                            <td>{{round($log->balance,$gnl->decimal)}} {{$gnl->cur}}</td>
                            <td>{{$log->details}}</td>
                            <td>{{$log->trxid}}</td>
                            <td>{{$log->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                {{$logs->links()}}
            </div>
        </div>
    </div>
</div>

@endsection





