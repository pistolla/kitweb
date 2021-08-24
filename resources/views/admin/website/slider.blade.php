@extends('layouts.admin')
@section('page_styles')
<link rel="stylesheet" href="{{asset('/css/bootstrap-fileinput.css')}}">
@endsection
@section('right_action')
<button class="btn btn-md btn-primary" data-toggle="modal" data-target="#newSlider">
    <i class="fa fa-plus"></i> New Service
</button>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('admin.service-heading')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <h2 class="text-center">Section Heading</h2>
                    <textarea class="form-control" name="heading">{{$front->service_heading}}</textarea>
                </div>		
                <div class="form-group">
                    <h2 class="text-center">Section Details</h2>
                    <textarea class="form-control" name="details">{{$front->service_details}}</textarea>
                </div>							
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="tile">
    <div class="tile-title text-center">
        Services
    </div>
    <div class="tile-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Heading</th>
                            <th>Details</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $slide)
                        <tr>
                            <td>{{$slide->heading}}</td>
                            <td>{{substr($slide->details, 0,100)}} ...</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-info btn-sm updateButton" data-item="{{$slide->id}}" data-heading="{{$slide->heading}}" data-details="{{$slide->details}}"
                                        data-photo="{{asset('/images/slider')}}/{{$slide->photo}}" data-toggle="modal" data-target="#viewModal"> <i class="fa fa-edit"></i> Edit</button>
                                        <button  class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delModal{{$slide->id}}"><i class="fa fa-trash"></i> Delete</button>                            
                                    </div>
                                </td>
                            </tr>
                            <div id="delModal{{$slide->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Delete Service {{$slide->heading}}</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="POST" action="{{route('admin.slide-delete',$slide)}}" >
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
                    </div>
                </div>
            </div>
        </div>
        
        
        <div id="viewModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ModalLabel"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="updForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                                <div class="form-group card card-body">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img id="icon" alt="ad" style="width:100%;" /> 
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:200px;"> </div>
                                        <div>
                                            <span class="btn btn-success btn-file">
                                            <span class="fileinput-new"> Change Icon </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="icon"> </span>
                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input type="text" class="form-control" id="heading" name="heading">
                                </div>
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea name="details" class="form-control" id="details"  rows="7"></textarea>
                                </div>
                                
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">Update</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div id="newSlider" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">New Service</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="POST" action="{{route('admin.slide-store')}}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group card card-body">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:200px;"> </div>
                                            <div>
                                                <span class="btn btn-success btn-file">
                                                <span class="fileinput-new"> Change Icon </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="photo"> </span>
                                                <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h4>Service heading</h4>
                                        <input type="text"  class="form-control"  name="heading" >
                                    </div>
                                    
                                    <div class="form-group">
                                        <h4>Service Details</h4>
                                        <textarea class="form-control" name="details"></textarea>
                                    </div>								
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Create</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                
                @endsection
                @section('page_scripts')
                <script src="{{asset('/js/bootstrap-fileinput.js')}}"></script>
                
                <script>
                    
                    $(document).ready(function(){
                        $(document).on('click','.updateButton', function(){
                            $('#ModalLabel').text($(this).data('heading'));
                            $('#heading').val($(this).data('heading'));
                            $('#details').val($(this).data('details'));
                            let id = $(this).data('item');
                            let icon = $(this).data('icon');
                            let route = "{{url('/')}}"+'/admin/service-update/'+ id;
                            $('#updForm').attr('action',route);
                            $('#icon').attr('src',icon);
            
                        });
                    });
                    
                    
                </script>
                @endsection