@extends('layouts.admin')
@section('page_styles')
<script type="text/javascript" src="{{asset('/admin/js/nicEdit-latest.js')}}"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <form role="form" method="POST" action="{{route('admin.banner-update')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <h4>Section Heading</h4>
                        <input type="text" value="{{$front->banner_heading}}" class="form-control" id="banner_heading" name="banner_heading" >
                    </div>
                    <div class="form-group col-md-12">
                        <h4>Section Details</h4>
                        <textarea class="form-control" id="banner_details" name="banner_details" rows="7"> {{$front->banner_details}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 card card-body">
                        <h4>Banner Photo</h4>
                        <div class="form-group">
                            <img  id="uploadedImage"  src="{{ asset('/img/bg/header-bg.png') }}" style="width:100%"   />
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="banner_image" onchange="readURL(this);"> 
                        </div>                                    
                    </div>
                    <div class="col-md-6 card card-body">
                        <h4>Breadcrumb Photo</h4>
                        <div class="form-group">
                            <img  id="uploadedImage2"  src="{{ asset('/img/bg/breadcrumb-bg.png') }}" style="width:100%"  />
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="bread" onchange="readURL2(this);"> 
                        </div>                                    
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <hr>
                        <button type="submit" class="btn btn-lg btn-success btn-block">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('page_scripts')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#uploadedImage').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#uploadedImage2').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection