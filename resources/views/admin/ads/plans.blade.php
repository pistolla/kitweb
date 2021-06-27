@extends('layouts.admin') 

@section('right_action')
<button class="btn btn-md btn-primary" data-toggle="modal" data-target="#newPlan">
    <i class="fa fa-plus"></i> New Plan
</button>
@endsection

@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Plan Name</th>
                        <th>Credit</th>
                        <th>Price</th>
                        <th>Ad Type</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plans as $plan)
                    <tr>
                        <td>{{$plan->name}}</td>
                        <td>{{$plan->credit}}</td>
                        <td>{{$plan->price}} {{$gnl->cur}}</td>
                        <td> <span class=" badge {{$plan->type==1?'badge-info':'badge-warning'}}">{{$plan->type==1?'Impression':'Click'}}</span></td>
                        <td> <span class=" badge {{$plan->status==1?'badge-success':'badge-danger'}}">{{$plan->status==1?'Active':'Deactive'}}</span></td>
                        <td>
                            <button class="btn btn-info btn-md updateButton" data-item="{{$plan->id}}" data-name="{{$plan->name}}" data-credit="{{$plan->credit}}"
                                data-price="{{$plan->price}}" data-type="{{$plan->type}}" data-status="{{$plan->status}}"  data-toggle="modal" data-target="#viewModal"> <i class="fa fa-edit"></i> Edit</button>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="viewModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="ModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="updForm" role="form" method="POST">
                        @csrf 
                        @method('put') 
                        <div class="form-group">
                            <label>Plan Name</label>
                            <input id="name" type="text"  class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Credit</label>
                            <input type="text" id="credit"  class="form-control" name="credit">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <div class="input-group">
                                <input type="text" id="price" class="form-control" name="price">
                                <div class="input-group-append">
                                    <span class="input-group-text">{{$gnl->cur}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" name="type">
                                <option value="1" id="imp" >Impression</option>
                                <option value="2" id="click" >Click</option>
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <label>Status</label> 
                            <select class="form-control" name="status">
                                <option value="1" id="active">Active</option>
                                <option value="0" id="deactive">Dective</option>
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
    <div id="newPlan" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Plan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('admin.plan-store')}}">
                        @csrf 
                        <div class="form-group">
                            <label>Plan Name</label>
                            <input type="text"  class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Credit</label>
                            <input type="text"  class="form-control" name="credit">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <div class="input-group">
                                <input type="text"  class="form-control" name="price">
                                <div class="input-group-append">
                                    <span class="input-group-text">{{$gnl->cur}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" name="type">
                                <option value="1" >Impression</option>
                                <option value="2" >Click</option>
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <label>Status</label> 
                            <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Dective</option>
                            </select>
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
<script>
    $(document).ready(function(){
        $(document).on('click','.updateButton', function(){
            $('#ModalLabel').text($(this).data('name'));
            $('#name').val($(this).data('name'));
            $('#credit').val($(this).data('credit'));
            $('#price').val($(this).data('price'));
            let id = $(this).data('item');
            let route = "{{url('/')}}"+'/admin/plan-update/'+ id;
            $('#updForm').attr('action',route);

            let type = $(this).data('type');
            let status = $(this).data('status');
            if(status==1)
            {
                $('#active').attr('selected', true)
            }
            else
            {
                $('#deactive').attr('selected', true)
            }

            if(type==1)
            {
                $('#imp').attr('selected', true)
            }
            else
            {
                $('#click').attr('selected', true)
            }
        });
    });
</script>
@endsection