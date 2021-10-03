@extends('layouts.admin')

@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            Name 
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Username
                        </th>
                        <th>
                            Social Accounts
                        </th>
                        <th>
                            Date Joined
                        </th>
                        <th>
                            status
                        </th>
                        <th>
                            Action
                        </th>
                        <th>
                            Remove
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                    <tr>
                        <td>
                            {{$member->name}}
                        </td>
                        <td>
                            {{$member->email}}      
                        </td> 
                        <td>
                            {{$member->username}}      
                        </td>
                        <td>
                            @if ($member->accounts->count() > 0)
                                <span class="badge badge-info">Has social account</span><br>
                                @foreach ($member->accounts as $acc)
                                    <span class="badge badge-success"><a href="#">{{$acc->provider_name}}</a></span><br>
                                @endforeach
                            @else
                                <span class="badge badge-secondary">No social account</span>
                            @endif      
                        </td>
                        <td>
                            {{$member->created_at->diffForHumans()}}      
                        </td>
                        <td>
                            @if ($member->status == 1)
                                <span class="badge badge-success">Active</span>
                            @elseif ($member->status == 2)
                                <span class="badge badge-danger">InActive</span>
                            @else
                                <span class="badge badge-warning">Not Authenticated</span>
                            @endif     
                        </td>
                        <td>
                            @if($member->status == 1)
                            <button class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#removeModal{{$member->id}}"><i class="fa fa-ban"></i>Disable</button>                        
                            <div id="removeModal{{$member->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Deactivate {{$member->name}} ?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="delete-form" action="{{ route('admin.deactivate-member', $member->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <div class="form-group">   
                                                    <button type="submit" class="btn btn-danger btn-block">
                                                        Deactivate
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif ($member->status == 2)
                            <button class="btn btn-sm btn-success"  data-toggle="modal" data-target="#removeModal{{$member->id}}"><i class="fa fa-accept"></i>Enable</button>                        
                            <div id="removeModal{{$member->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Activate {{$member->name}} ?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="delete-form" action="{{ route('admin.activate-member', $member->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <div class="form-group">   
                                                    <button type="submit" class="btn btn-success btn-block">
                                                        Activate
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                        </td>
                        <td>
                            @if($member->status == 1)
                            <span class="badge badge-secondary">Active member cannot be deleted</span>
                            @else 
                            <button class="btn btn-danger"  data-toggle="modal" data-target="#removeModal{{$member->id}}"><i class="fa fa-trash"></i>Remove</button>                        
                            <div id="removeModal{{$member->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Remove {{$member->name}} ?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="delete-form" action="{{ route('admin.delete-member', $member->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <div class="form-group">   
                                                    <button type="submit" class="btn btn-danger btn-block">
                                                        Remove
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                        </td>
                    </tr>
                    @endforeach 
                    <tbody>
                    </table>
                </div>    
            </div>
            <div class="row">
                <div class="col-md-12">
                {{$members->links("pagination::bootstrap-4")}}
                </div>
            </div>
        </div>
        @endsection