@extends('layouts.admin')
@section('right_action')
<button class="btn btn-md btn-primary" data-toggle="modal" data-target="#newSocial">
    <i class="fa fa-plus"></i> New Social Icon
</button>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        @php $n = 1; @endphp
        @foreach($socials as $social)
        
        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-header text-center">
                    Social Icon No: <strong>{{$n}}</strong>
                    <button class="pull-right btn btn-sm btn-danger"  data-toggle="modal" data-target="#delModal{{$social->id}}"><i class="fa fa-trash"></i></button>
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{route('admin.social-update',$social->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        
                        <div class="form-group">
                            <h4>Social Link</h4>
                            <input type="text" value="{{$social->link}}" class="form-control"  name="link" >
                        </div>
                        <div class="form-group">
                            <h4>Social Icon : <i class="fa fa-{{$social->icon}}"></i>  <a target="_blank" href="https://fontawesome.com/icons/" class="pull-right">Fontawesome Icon</a></h4>
                            
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">fa fa-</span>
                                    
                                </div>
                                <input type="text" value="{{$social->icon}}" class="form-control"  name="icon" >
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block">Update</button>
                        </div>
                        
                    </form>
                </div>
            </div>				
        </div>
    <div id="delModal{{$social->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Delete Social Icon {{$n}}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="POST" action="{{route('admin.social-delete',$social)}}" >
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-danger btn-block">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @php $n = $n+1; @endphp
        @endforeach
    </div>
</div>
<div id="newSocial" class="modal fade" role="dialog">
    <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Social Icon</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{route('admin.social-store')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <h4>Social Link</h4>
                        <input type="text"  class="form-control"  name="link" >
                    </div>
                    <div class="form-group">
                        <h4>Social Icon <a target="_blank" href="https://fontawesome.com/icons/" class="pull-right">Fontawesome Icon</a></h4> 
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">fa fa-</span>
                                
                            </div>
                            <input type="text"  class="form-control"  name="icon" >
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
