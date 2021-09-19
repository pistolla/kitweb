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
                <form  class="mobile-payment" method="POST" onSubmit="handleSubmit()" action="{{ route('deposit.mpesa') }}">
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
                                    <button type="submit"  class="submit-btn" style="width:100%;">
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
    <script>
    
        function handleSubmit(event){
            
            var form = $(this);
            form.preventDefault();
            var formData = {
                "gateway": form.find('#gateway_id').val(),
                "trx": form.find("#trx_id").val(),
            };

            postRequest(formData);
        }

        function postRequest(data) {
            $.ajax({
                url: "/home/deposit-mpesa",
                type: "POST",
                data: data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: postSuccess,
                error: postError
            });
        }

        function postSuccess(data, status, jqXhr) {
            Swal.fire({
                title: 'Please enter MPESA transaction code',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'on'
                },
                showCancelButton: true,
                confirmButtonText: 'Send',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    return fetch(login).then(response => {
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
                        title: `${result.value.login}'s avatar`,
                        imageUrl: result.value.avatar_url
                    })
                }
            })
        }

        function postError(jqXhr, status, errorThrown) {

        }
    
    </script>
@endsection
 