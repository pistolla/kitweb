@extends('layouts.user')
@section('page_styles')

<style>
	.credit-card-box .form-control.error {
		border-color: red;
		outline: 0;
		box-shadow: inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(255,0,0,0.6);
	}
	.credit-card-box label.error {
		font-weight: bold;
		color: red;
		padding: 2px 8px;
		margin-top: 2px;
	}
</style>
@endsection
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
				<div class="card-wrapper"></div>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 mx-auto card card-body">
				<form class="contact-form" role="form" id="payment-form" method="POST" action="{{ route('ipn.stripe')}}" >
					@csrf
					<input type="hidden" value="{{ $track }}" name="track">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">CARD NAME</label>
								<div class="input-group-append">
									<input type="text" class="form-control input-lg"
									name="name"
									placeholder="Card Name"
									autocomplete="off" autofocus
									/>
									<span class="input-group-text"><i class="fa fa-font"></i></span>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="cardNumber">CARD NUMBER</label>
								<div class="input-group-append">
									<input
									type="tel"
									class="form-control input-lg"
									name="cardNumber"
									placeholder="Valid Card Number"
									autocomplete="off"
									required autofocus
									/>
									<span class="input-group-text"><i class="fa fa-credit-card"></i></span>
								</div>
							</div>
						</div>
					</div>
					<br>
					
					<div class="row">
						<div class="col-xs-7 col-md-7">
							<div class="form-group">
								<label for="cardExpiry">EXPIRATION DATE</label>
								<input
								type="tel"
								class="form-control input-lg"
								name="cardExpiry"
								placeholder="MM / YYYY"
								autocomplete="off"
								required
								/>
							</div>
						</div>
						<div class="col-xs-5 col-md-5 float-right">
							<div class="form-group">
								<label for="cardCVC">CVC CODE</label>
								<input
								type="tel"
								class="form-control input-lg"
								name="cardCVC"
								placeholder="CVC"
								autocomplete="off"
								required
								/>
							</div>
						</div>
					</div>					
					<div class="row">
						<div class="col-md-12">
							<button class="submit-btn btn btn-block" style="width:100%;" type="submit"> PAY NOW </button>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</section>
@endsection

@section('page_scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/card/2.4.0/card.min.js"></script>
<script>
	(function ($) {
		$(document).ready(function () {
			var card = new Card({
				form: '#payment-form',
				container: '.card-wrapper',
				formSelectors: {
					numberInput: 'input[name="cardNumber"]',
					expiryInput: 'input[name="cardExpiry"]',
					cvcInput: 'input[name="cardCVC"]',
					nameInput: 'input[name="name"]'
				}
			});
		});
	})(jQuery);
</script>
@endsection


