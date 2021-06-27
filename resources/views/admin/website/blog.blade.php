@extends('layouts.admin')
@section('page_styles')
<script type="text/javascript" src="{{asset('/admin/js/nicEdit-latest.js')}}"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
@endsection
@section('right_action')
<a href="{{route('admin.blogcreate')}}" class="btn btn-md btn-primary">
    <i class="fa fa-plus"></i> New Blog Post
</a>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td>{{$blog->heading}}</td>
                        <td>{{substr(strip_tags($blog->details), 0, 100)}} ...</td>
                        <td> 
                            <div class="btn-group">
                            <a href="{{route('admin.blog-single', $blog->id)}}"> <i class="fa fa-edit"></i> <button  class="btn btn-info">Edit</button> </a>
                            <button  class="pull-right btn btn-sm btn-danger" data-toggle="modal" data-target="#delModal{{$blog->id}}"><i class="fa fa-trash"></i> Delete</button>
                            </div>
                        </td>
                    </tr>
                    
                    <div id="delModal{{$blog->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete {{$blog->heading}}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" method="POST" action="{{route('admin.blog-delete',$blog)}}" >
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
            {{$blogs->links()}}
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