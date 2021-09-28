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
                            Remove
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $adm)
                    <tr>
                        <td>
                            {{$adm->name}}
                        </td>
                        <td>
                            {{$adm->email}}      
                        </td> 
                        <td>
                            {{$adm->username}}      
                        </td>
                        <td>
                            @if($adm->id == 1 || $adm->id == Auth::guard('admin')->user()->id)
                            <span class="badge badge-secondary">Can Not Remove</span>
                            @else 
                            <button class="btn btn-danger"  data-toggle="modal" data-target="#removeModal{{$adm->id}}"><i class="fa fa-trash"></i>Remove</button>                        
                            <div id="removeModal{{$adm->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Remove {{$adm->name}} ?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="delete-form" action="{{ route('admin.delete-admin', $adm->id) }}" method="POST">
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
                {{$admins->links("pagination::bootstrap-4")}}
                </div>
            </div>
        </div>
        @endsection