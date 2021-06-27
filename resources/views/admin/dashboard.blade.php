@extends('layouts.admin')

@section('content')
<div class="tile">
  <div class="card-body">
    <div class="row">
      <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
          <div class="info">
            <h4>Advertisers</h4>
            <p><b>{{$users}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-bullhorn fa-3x"></i>
          <div class="info">
            <h4>Publishers</h4>
            <p><b>{{$pub}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-share fa-3x"></i>
          <div class="info">
            <h4>Withdraw Req</h4>
            <p><b>{{$withdraw}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-plus fa-3x"></i>
          <div class="info">
            <h4>Total Deposit</h4>
            <p><b>{{$deposit}}</b> {{$gnl->cur}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-4">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-image fa-3x"></i>
          <div class="info">
            <h4>Total Ads</h4>
            <p><b>{{$ads}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="widget-small warning coloured-icon"><i class="icon fa fa-globe fa-3x"></i>
          <div class="info">
            <h4>Total Impression</h4>
            <p><b>{{$views}}</b></p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-mouse-pointer fa-3x"></i>
          <div class="info">
            <h4>Total Click</h4>
            <p><b>{{$click}}</b></p>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
<div class="tile">
  <h1 class="text-center">Advertisements</h1>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Ad Type</th>
        <th>Redirect URL</th>
        <th>Ad Type</th>
        <th>Estimated Amount</th>
        <th>Clicked</th>
        <th>Impression</th>
        <th>Status</th>
        <th>View</th>
      </tr>
    </thead>
    <tbody>
      @if(count($advertises)==0) <h3>No Ads Available</h3> @endif
      @foreach($advertises as $ad)
      <tr>
        <td>{{$ad->adtype->name}}</td>
        <td>{{$ad->link}}</td>
        <td>
          <span class="badge {{$ad->click==1?'badge-success':'badge-info'}}">{{$ad->click==1?'Click':'Impression'}}</span>
        </td>
        
        <td>{{$ad->total}} {{$ad->click==1?'Click':'Impression'}}</td>
        <td>{{$ad->count_click}}</td>
        <td>{{$ad->count_imp}}</td>
        <td>
          <span class="badge {{$ad->status==1?'badge-secondary':'badge-danger'}}">
            {{$ad->status==1?'Active':'Deactive'}}
          </span>
        </td>
        <td>
          <button class="btn btn-info btn-sm updButton" data-target="#updateModal" data-toggle="modal" data-photo="{{asset('/images/ads')}}/{{$ad->photo}}" ><i class="fa fa-eye"></i> View</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{$advertises->links()}}  
</div>
</div>
</div>



<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="uploadedImageu"  alt="your image" style="width:100%;"/>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('page_scripts')
<script>
  
  $(document).ready(function(){
    
    $(document).on('click','.updButton', function(){
      $('#ModalTitle').text($(this).data('name'));
      var photo =  $(this).data('photo')
      $('#uploadedImageu').attr('src',photo);
      
      
    });
    
  });
</script>
@endsection