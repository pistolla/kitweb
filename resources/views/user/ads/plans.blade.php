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
        <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">
                        Impression Credit
                    </div>
                    <div class="card-body">
                        <h3>{{Auth::user()->credit}}</h3> 
                    </div>
                </div>                 
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">
                        BALANCE
                    </div>
                    <div class="card-body">
                        <h3>{{round(Auth::user()->balance,$gnl->decimal)}} {{$gnl->cur}}</h3> 
                    </div>
                </div>                 
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-header">
                       Click Credit
                    </div>
                    <div class="card-body">
                        <h3>{{Auth::user()->click}}</h3> 
                    </div>
                </div>                 
            </div>

        </div>
        <div class="row margin-bottom-20 mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Credit Plans</div>
                    <div class="card-body">
                        <div class="row">
                        @foreach($plans as $plan)
                        <div class="col-md-3 mt-2">
                            <div class="card">
                                <div class="card-header text-center">{{$plan->name}}</div>
                                <div class="card-body">
                                    <ul class="list-group text-center">
                                        <li class="list-group-item">
                                            Type: <strong>{{$plan->type==1?'Impression':'Click'}}</strong>
                                        </li>
                                        <li class="list-group-item">
                                            Credit: <strong>{{$plan->credit}}</strong>
                                        </li>
                                        <li class="list-group-item">
                                            Price: <strong>{{$plan->price}}</strong> {{$gnl->cur}}
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <button data-toggle="modal" data-name="{{$plan->name}}" data-price="{{$plan->price}}" data-plan="{{$plan->id}}"  data-target="#planModal" class="submit-btn depoButton" style="width:100%;">
                                        Get Now
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
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="planModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.get-plan')}}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" id="planId"/>
                <h4><strong id="planPrice"></strong> {{$gnl->cur}} Will be deducted from your balance.</h4>
                    <div class="form-group">
                        <button type="submit" class="submit-btn" style="width:100%;">Purchase This Plan</button>
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
            $('#planPrice').text($(this).data('price'));
            $('#planId').val($(this).data('plan'));
        });
    });
</script>

@endsection



