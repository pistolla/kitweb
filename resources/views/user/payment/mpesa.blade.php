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
                <form  class="mobile-payment" method="POST" action="{{ route('deposit.mpesa') }}">
                    @csrf
                    <input id="gateway_id" type="hidden" name="gateway" value="{{$datum['gateway_id'] }}"/>
                    <input id="trx_id" type="hidden" name="trx" value="{{$datum['trx_id']}}"/>
                    <div class="panel panel-default">
                        <div class="panel-body p-5">
                            <div class="card-body d-flex">
                                <div class="media-body">
                                    <img src="{{asset('/images/gateway')}}/{{$datum['gateway_id'] }}.jpg" style="max-width:200px; max-height:200px; margin:0 auto;"/>
                                </div>
                                <div>
                                    <ul class="list-group text-center">
                                        <li class="list-group-item borderless">PAYBILL: <strong>{{ $datum['paybill'] }}</strong></li>
                                        <li class="list-group-item borderless">ACCOUNT: <strong>{{ $datum['account'] }}</strong></li>
                                        <li class="list-group-item borderless">AMOUNT: <strong>{{ $datum['amount'] }}</strong></li>
                                    </ul>
                                    <button type="submit"  class="submit-btn"  onclick="handleSubmit({{$datum['trx_id']}}, {{$datum['gateway_id']}})" style="width:100%;">
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
