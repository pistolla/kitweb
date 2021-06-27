@extends('layouts.admin')
@section('page_styles')
<script type="text/javascript" src="{{asset('/js/nicEdit-latest.js')}}"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form role="form" method="POST" action="{{route('admin.blog-update',$blog->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <img id="uploadedImage" class="form-control" src="{{ asset('/images/blog') }}/{{$blog->photo}}" style="width:50%; margin: 0 auto;" /> 
                        </div>
                        <div class="form-group">
                            <input type="file" name="photo"  onchange="readURL(this);"> 
                        </div>
                        <div class="form-group">
                            <h4>Post heading</h4>
                            <input type="text" value="{{$blog->heading}}" class="form-control"  name="heading" >
                        </div>
                        <div class="form-group">
                            <h4>Post Details</h4>
                            <textarea class="form-control" name="details" rows="3">{{$blog->details}}</textarea>
                        </div>								
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>				
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