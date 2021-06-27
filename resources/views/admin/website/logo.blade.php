@extends('layouts.admin')
@section('page_styles')
<link rel="stylesheet" href="{{asset('/css/bootstrap-fileinput.css')}}">
@endsection
@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{route('admin.logoupdate')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group card card-body bg-dark">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail">
                                    <img src="{{ asset('/images/logo/logo.png') }}" style="width:100%" alt="logo" /> 
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:300px;"> </div>
                                <div>
                                    <span class="btn btn-success btn-file">
                                        <span class="fileinput-new"> Change Logo </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="logo"> </span>
                                        <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group card card-body bg-dark">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" >
                                        <img src="{{ asset('/images/logo/icon.png') }}" style="width:100%" alt="icon" /> 
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:300px;"> </div>
                                    <div>
                                        <span class="btn btn-success btn-file">
                                            <span class="fileinput-new"> Change Icon </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="icon"> </span>
                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-actions right">
                            <button type="submit" class="btn btn-success btn-lg btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        
        @endsection
        @section('page_scripts')
        <script src="{{asset('/js/bootstrap-fileinput.js')}}"></script>
        @endsection