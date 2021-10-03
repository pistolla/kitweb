@extends('layouts.user')

@section('content')

<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="title">{{$pt}}</h1>
                    <h4>Balance : <strong>{{round(Auth::user()->balance,$gnl->decimal)}} {{$gnl->cur}}</strong></h4> 
                    @include('layouts.error')
                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimonial-page-conent">
    <div class="container">
        @if ($pending->count() > 0)
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Pending Deposit transaction</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($pending as $key => $value)
                            <div class="col-md-4 mt-2">
                                <div class="card">
                                <form  class="mobile-payment" method="POST" action="{{ route('deposit.complete') }}">
                                    @csrf
                                    <input id="gateway_id" type="hidden" name="gateway" value="{{$value->gateway_id}}"/>
                                    <input id="trx_id" type="hidden" name="trx" value="{{$value->id}}"/>
                                    <div class="card-body">
                                        <div class="card-header text-center">{{$value->gateway->name}}</div>
                                        <div class="media-body mx-auto">
                                            <img src="{{asset('/images/gateway')}}/{{$value->gateway_id}}.jpg" style="max-width:200px; max-height:200px;"/>
                                        </div>
                                        <div>
                                            <ul class="list-group text-center">
                                                <li class="list-group-item borderless">STATUS: <strong>{{ $value->statustext() }}</strong></li>
                                                <li class="list-group-item borderless">DATE INITIATED: <strong>{{ $value->created_at->diffForHumans() }}</strong></li>
                                                <li class="list-group-item borderless">AMOUNT: <strong>{{$value->amount}} {{$gnl->cur}}</strong></li>
                                            </ul>
                                        </div>
                                    </div>
                                    @if ($value->status == 0)
                                        @if ($value->gateway_id == 101)
                                            <button type="submit" class="submit-btn" onclick="handleSubmit({{$value->id}}, {{$value->gateway_id}})" style="width:100%;">
                                                PAY NOW
                                            </button>
                                        @else
                                            <button type="submit" class="submit-btn" style="width:100%;">
                                                PAY NOW
                                            </button>
                                        @endif
                                        
                                    </form>
                                        <form id="delete-form" action="{{ route('cancel.deposit', $value->id) }}" method="POST">
                                            @csrf
                                            @method('delete')   
                                            <button type="submit" class="btn info-danger btn-lg"  style="width:100%;">
                                            CANCEL
                                            </button>
                                        </form>
                                    @elseif ($value->status == 2)
                                        <button type="button" class="submit-btn" style="width:100%;">
                                            Confirm Transaction Code
                                        </button>
                                    @else
                                        <button type="button" class="submit-btn" style="width:100%;">
                                            Request assistance
                                        </button>
                                    @endif
                                
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Deposit Methods</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($gates as $key => $gate)
                            <div class="col-md-4 mt-2">
                                <div class="card">
                                    <div class="card-header text-center">{{$gate->name}}</div>
                                    <div class="card-body">
                                        <ul class="list-group text-center">
                                            <li class="list-group-item">
                                                <img src="{{asset('/images/gateway')}}/{{$gate->id}}.jpg" style="width:100%;"/>
                                            </li>
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
                                            Deposit Now
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
        
        <div class="row">
            <div class="col-md-12 mx-auto mt-3">
                <hr>
                <h3 class="text-center">Deposits</h3>
                <div style="overflow-x:auto;">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Gateway</th>
                                <th class="text-center">TRX ID</th>
                                <th class="text-center">TRX Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($deposit)==0) 
                            <tr>
                                <td colspan="4"><h2>No Data Available</h2></td>
                            </tr>
                            @endif
                            @foreach($deposit as $log)
                            <tr>
                                <td>{{$log->amount}} {{$gnl->cur}}</td>
                                <td>{{$log->gateway->name}}</td>
                                <td>{{$log->trx}}</td>
                                <td>{{$log->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    {{$deposit->links()}}
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
                <form action="{{route('deposit.data-insert')}}" method="POST">
                    @csrf
                    <input type="hidden" name="gateway" id="gateWay"/>
                    <div class="form-group">
                        <h5>Enter Deposit Amount</h5>
                        <div class="input-group-append">
                            <input type="text" name="amount" class="form-control"/>                            
                            <span class="input-group-text">{{$gnl->cur}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="submit-btn" style="width:100%;">Deposit Preview</button>
                        
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        $(document).on('click','.depoButton', function(){
            $('#ModalLabel').text($(this).data('name'));
            $('#gateWay').val($(this).data('gate'));
        });

        $(document).on('submit','.mobile-payment', function(event){
            event.preventDefault();
        })
    });
</script>
<script>
        function handleSubmit(trx, gateway,event){
            var formData = {
                "gateway": gateway,
                "trx": trx,
                '_token': $('meta[name="csrf-token"]').attr('content')
            };
            Swal.fire({
                title: 'Please confirm you want to complete payment?',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return  fetch('/home/deposit-mpesa', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json;charset=utf-8',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify(formData)
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Payment failed!',
                                text: error.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                                });
                            })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                console.log(result);
                Swal.fire({
                    title: 'Please, CHECK your phone, complete transaction and enter MPESA transaction code',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'on'
                    },
                    showCancelButton: false,
                    confirmButtonText: 'Send',
                    showLoaderOnConfirm: true,
                    preConfirm: (code) => {
                        return fetch('/home/mpesa-confirm', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json;charset=utf-8',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify({"code": code, "trx_id": trx, "_token": $('meta[name="csrf-token"]').attr('content')})
                        }).then(response => {
                            if(!response.ok){
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(`Request failed: ${error}`)
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if(result.isConfirmed) {
                        Swal.fire({
                            title: 'Code confirmed',
                            icon: 'success'
                        })
                    }
                })
            });
        }
    </script>
@endsection



