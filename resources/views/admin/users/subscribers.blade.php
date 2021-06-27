@extends('layouts.admin')

@section('content')

<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Send News Letter
                </div>
                <div class="card-body">
                    <form role="form" method="POST" action="{{route('admin.subscribers-email')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="subject" class="form-control input-lg">
                            </div>
                            <div class="form-group">
                                <label>Email Message</label>
                                <textarea class="form-control" name="emailMessage" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="submit-btn btn btn-primary btn-lg btn-block login-button">Broadcast Email</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Subscribers</div>
                <div class="card-body">
                    @if(count($subs)==0)<h4 class="text-center">No Data Available</h2> @endif
                        @foreach($subs as $sub)
                        <strong>{{$sub->email}} <i class="fa fa-times" style="cursor:pointer; color:red;" data-toggle="modal" data-target="#cancelModal{{$sub->id}}"></i></strong> | &nbsp;
                        
                        <!-- Cancel Modal -->
                        <div id="cancelModal{{$sub->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete {{$sub->email}} ?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="delete-form" action="{{ route('admin.subscriber-delete', $sub->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <div class="form-group">   
                                                <button type="submit" class="btn btn-danger btn-block">
                                                    Delete
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    @endsection