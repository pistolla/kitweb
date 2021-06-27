@extends('layouts.admin')
@section('page_styles')
<script type="text/javascript" src="{{asset('/admin/js/nicEdit-latest.js')}}"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <form role="form" method="POST" action="{{route('admin.about-update')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <h4>Section Heading</h4>
                    <input type="text" value="{{$front->about_heading}}" class="form-control" id="about_heading" name="about_heading" >
                </div>
                <div class="form-group">
                    <h4>Background Photo</h4>
                    <div class="card card-body">
                            <img  id="uploadedImage"  src="{{ asset('/images/frontend') }}/{{$front->about_image}}" style="width:50%; margin:0 auto;"  />
                    </div>
                    <input type="file" class="form-control" name="about_image" onchange="readURL(this);"> 
                </div>
                <div class="form-group">
                    <h4>Section Details</h4>
                    <textarea class="form-control" id="about_details" name="about_details" rows="7">{{$front->about_details}}</textarea>
                </div>
                <div class="form-group">
                    <h4>Video URL</h4>
                    <input type="text" value="{{$front->video}}" class="form-control" id="video" name="video" >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Update</button>
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
</script>
@endsection