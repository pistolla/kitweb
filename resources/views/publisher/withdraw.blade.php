@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="title">{{$pt}}</h1>
                    @include('layouts.error')
                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimonial-page-conent">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header text-center">Withdraw Methods</div>
                <div class="card-body">
                    <div class="row">
                        @foreach($gates as $gate)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header text-center">{{$gate->name}}</div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            Limit: <strong>{{$gnl->cursym}}{{$gate->minamo}}</strong> ~ <strong>{{$gnl->cursym}}{{$gate->maxamo}}</strong>
                                        </li>
                                        <li class="list-group-item">
                                            Charge: <strong>{{$gnl->cursym}}{{$gate->fixed_charge}}</strong> + <strong>{{$gate->percent_charge}} %</strong>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <button data-toggle="modal" data-name="{{$gate->name}}" data-gate="{{$gate->id}}"  data-target="#depoModal" class="submit-btn depoButton" style="width:100%;">
                                        Withdraw Now
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="depoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('withdraw.post')}}" method="POST">
                    @csrf
                    <input type="hidden" name="gateway" id="gateWay"/>
                    <div class="form-group">
                        <h5>Withdraw Amount</h5>
                        <div class="input-group-append">
                            <input type="text" name="amount" class="form-control"/>                            
                            <span class="input-group-text">{{$gnl->cursym}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Account Details</h5>
                        <textarea class="form-control" name="account"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="submit-btn" style="width:100%;">Confirm Withdraw</button>
                    </div>
                    
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('page_scripts')
<script>
    $(document).ready(function(){
        
        $(document).on('click','.depoButton', function(){
            $('#ModalLabel').text($(this).data('name'));
            $('#gateWay').val($(this).data('gate'));
        });
    });
</script>

@endsection



