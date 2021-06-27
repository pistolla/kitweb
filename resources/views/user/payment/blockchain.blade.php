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
					<div class="col-md-8 mx-auto">
						<div class="card">
							<div class="card-body text-center">
						<h6> PLEASE SEND EXACTLY <span style="color: green"> {{ $bitcoin->amount }}</span> BTC</h6>
						<h5>TO <span style="color: green"> {{ $bitcoin->sendto }}</span></h5>
						{!! $bitcoin->code !!}
						<h4 style="font-weight:bold;">SCAN TO SEND</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection