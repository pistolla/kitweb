@extends('layouts.admin')

@section('content')
<div class="tile">
	<div class="row">
		<div class="col-md-12">
			
			<form role="form" method="POST" action="{{route('admin.gnlupdate')}}">
				@csrf
				<div class="row">
					<div class="col-md-6">
						<label>Website Title</label>
						<input type="text" class="form-control input-lg" value="{{$general->title}}" name="title" >
					</div>
					<div class="col-md-6">
						<label>Website Sub-Title</label>
						<input type="text" class="form-control input-lg" value="{{$general->subtitle}}" name="subtitle" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<label>BASE COLOR CODE</label>
						<input type="color" class="form-control input-lg"  value="#{{$general->color}}" name="color" style="height:35px;"  />
					</div>
					
					<div class="col-md-2">
						<label>BASE CURRENCY CODE</label>
						<input type="text" class="form-control input-lg" value="{{$general->cur}}" name="cur" >
					</div>
					<div class="col-md-2">
						<label>BASE CURRENCY SYMBOL</label>
						<input type="text" class="form-control input-lg" value="{{$general->cursym}}" name="cursym" >
					</div>
					<div class="col-md-2">
						<label>DECIMAL AFTER POINT</label>
						<input type="number" value="{{$general->decimal}}" name="decimal" class="form-control input-lg" >
					</div>
					<div class="col-md-2">
						<label>Per View</label>
						<div class="input-group">
						    <div class="input-group-append">
						        <input type="text" class="form-control input-lg" value="{{$general->view}}" name="view" >
						        <span class="input-group-text">{{$gnl->cur}}</span>
						    </div>
						</div>
					</div>
					<div class="col-md-2">
						<label>Per Click</label>
						<div class="input-group">
						    <div class="input-group-append">
						        <input type="text" class="form-control input-lg" value="{{$general->click}}" name="click" >
						        <span class="input-group-text">{{$gnl->cur}}</span>
						    </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label>Registration</label>
						<div class="toggle lg">
							<label>
								<input type="checkbox" value="1" name="reg" {{ $general->reg == "1" ? 'checked' : '' }}><span class="button-indecator"></span>
							</label>
						</div>
					</div>
					
					<div class="col-md-3">
						<label>EMAIL VERIFICATION</label>
						<div class="toggle lg">
								<label>
									<input type="checkbox" value="1" name="emailver" {{ $general->emailver == "0" ? 'checked' : '' }}><span class="button-indecator"></span>
								</label>
							</div>
					</div>
					<div class="col-md-2">
						<label>SMS VERIFICATION</label>
						<div class="toggle lg">
								<label>
									<input type="checkbox" value="1" name="smsver"  {{ $general->smsver == "0" ? 'checked' : '' }}><span class="button-indecator"></span>
								</label>
							</div>
					</div>
					<div class="col-md-2">
						<label>EMAIL NOTIFY</label>
						<div class="toggle lg">
								<label>
									<input type="checkbox" value="1" name="emailnotf"  {{ $general->emailnotf == "1" ? 'checked' : '' }}><span class="button-indecator"></span>
								</label>
							</div>
					</div>
					<div class="col-md-2">
						<label>SMS NOTIFY</label>
						<div class="toggle lg">
								<label>
									<input type="checkbox"  value="1" name="smsnotf" {{ $general->smsnotf == "1" ? 'checked' : '' }}><span class="button-indecator"></span>
								</label>
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr/>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 ml-auto mr-auto">
						<button class="btn btn-success btn-block btn-lg">Update</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
