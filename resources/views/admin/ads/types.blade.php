@extends('layouts.admin') 
@section('page_styles')
<link rel="stylesheet" href="{{asset('/css/bootstrap-fileinput.css')}}">
@endsection
@section('right_action')
<button class="btn btn-md btn-primary" data-toggle="modal" data-target="#newType">
<i class="fa fa-plus"></i> New Type
</button>
@endsection 
@section('content')
<div class="tile">
<div class="row">
<div class="col-md-12">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Ad Name</th>
                <th>Ad Type</th>
                <th>Ad Width</th>
                <th>Ad Height</th>
                <th>Ad Slag</th>
                <th>Status</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adtypes as $type)
            <tr>
                <td>{{$type->name}}</td>
                <td>{{$type->type}}</td>
                <td>{{$type->width}}px</td>
                <td>{{$type->height}}px</td>
                <td>{{$type->slag}}</td>
                <td><span class="badge {{$type->status==1?'badge-success':'badge-danger'}}">{{$type->status==1?'Active':'Deactive'}}</span></td>
            <td> <button class="btn btn-info btn-lg updateButton" data-typeid="{{$type->id}}" data-name="{{$type->name}}" data-type="{{$type->type}}"
                    data-width="{{$type->width}}" data-height="{{$type->height}}" data-slag="{{$type->slag}}" data-status="{{$type->status}}"
                    data-toggle="modal" data-target="#viewModal">Edit</button></td>
                </tr>
                @endforeach
            </tbody>
            
        </table>  
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
                <div class="form-group">
                    <label>Ad Name</label>
                    <input type="text" class="form-control" id="adName" name="name">
                </div>
                <div class="form-group">
                    <label>Ad Type</label>
                    <input type="text"  class="form-control" id="adType" name="type">
                </div>
                <div class="form-group">
                    <label>Ad Width</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="adWidth" name="width">
                        <div class="input-group-append">
                            <span class="input-group-text">Pixel</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ad Height</label>
                    <div class="input-group">
                        <input type="text"  class="form-control" id="adHeight" name="height">
                        <div class="input-group-append">
                            <span class="input-group-text">Pixel</span>
                        </div>
                    </div>
                </div>
                <div class="form-group card card-body">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            <img id="adPhoto" alt="ad" style="width:100%;" /> 
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:300px;"> </div>
                        <div>
                            <span class="btn btn-success btn-file">
                                <span class="fileinput-new"> Change Default Ad </span>
                                <span class="fileinput-exists"> Change </span>
                                <input type="file" name="photo"> </span>
                                <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" id="adStatusAct" >Active</option>
                            <option value="0" id="adStatusDact" >Deactive</option>
                        </select>
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
<div id="newType" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">New Ad Type</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form role="form" method="POST" action="{{route('admin.ad-store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Ad Name</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label>Ad Type</label>
                    <input type="text"  class="form-control" name="type">
                </div>
                <div class="form-group">
                    <label>Ad Width</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="width">
                        <div class="input-group-append">
                            <span class="input-group-text">Pixel</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ad Height</label>
                    <div class="input-group">
                        <input type="text"  class="form-control" name="height">
                        <div class="input-group-append">
                            <span class="input-group-text">Pixel</span>
                        </div>
                    </div>
                </div>
                <div class="form-group card card-body">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            <img src="" alt="" style="width:100%;" /> 
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:300px;"> </div>
                        <div>
                            <span class="btn btn-success btn-file">
                                <span class="fileinput-new"> Upload Default Ad </span>
                                <span class="fileinput-exists"> Change </span>
                                <input type="file" name="photo"> </span>
                                <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                            </div>
                        </div>
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
            $('#ModalLabel').text($(this).data('name'));
            $('#adName').val($(this).data('name'));
            $('#adType').val($(this).data('type'));
            $('#adWidth').val($(this).data('width'));
            $('#adHeight').val($(this).data('height'));
            $('#adSlag').val($(this).data('slag'));
            let id = $(this).data('typeid');
            let route = "{{url('/')}}"+'/admin/type-update/'+ id;
            $('#updForm').attr('action',route);

            let slag = $(this).data('slag');
            let photo = "{{asset('/ads')}}/" + slag +'.png'
            $('#adPhoto').attr('src',photo);

            let status = $(this).data('status');
            if(status==1)
            {
                $('#adStatusAct').attr('selected', true)
            }
            else
            {
                $('#adStatusDact').attr('selected', true)
            }
        });
    });
</script>
@endsection