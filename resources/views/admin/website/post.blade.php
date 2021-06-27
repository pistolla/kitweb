@extends('layouts.admin')
@section('page_styles')
<script type="text/javascript" src="{{asset('/js/nicEdit-latest.js')}}"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-body">
                <form role="form" method="POST" action="{{route('admin.blog-store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <img id="uploadedImage2" class="form-control"  style="width:100%" /> 
                    </div>
                    
                    <div class="form-group">
                        <h4>Upload Thumbnail</h4>
                        <input type="file" name="photo"  onchange="readURL2(this);"> 
                    </div>
                    <div class="form-group">
                        <h4>Post heading</h4>
                        <input type="text"  class="form-control"  name="heading" >
                    </div>
                    <div class="form-group">
                        <h4>Post tags (separate each using comma)</h4>
                        <input type="text"  class="form-control"  name="tags" >
                    </div>
                    <div class="form-group">
                        <h4>Post tags (separate each using comma)</h4>
                        <select class="form-control">
                            @foreach (App\Category::get() as $category)
                            $selected = '';
                            if($category->id == 1)
                            {
                                $selected = 'selected="selected"';
                            }
                            <option value='{{ $category->id }}' {{$selected}}> {{$category->name }}</option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <h4>Post Details</h4>
                        <textarea class="form-control" name="details" rows="10"></textarea>
                    </div>								
                    
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Create</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page_scripts')
<script>
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