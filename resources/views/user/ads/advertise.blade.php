@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="title">{{$pt}}</h1>
                    @include('layouts.error')
                </div>
            </div>
        </div>
    </div>
</section>
<section class="testimonial-page-conent">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Type of Advertisements</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($types as $typ)
                            <div class="col-md-3 mt-2">
                                <div class="card">
                                    <div class="card-header text-center">{{$typ->name}}</div>
                                    <div class="card-body">
                                        <ul class="list-group text-center">
                                            <li class="list-group-item">
                                                Type: <strong>{{$typ->type}}</strong>
                                            </li>
                                            <li class="list-group-item">
                                                Width: <strong>{{$typ->width}}</strong> Pixel
                                            </li>
                                            <li class="list-group-item">
                                                Height: <strong>{{$typ->height}}</strong> Pixel
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-footer">
                                        <button data-toggle="modal" data-name="{{$typ->name}}"  data-type="{{$typ->id}}" data-width="{{$typ->width}}" 
                                            data-height="{{$typ->height}}"  data-target="#planModal" class="submit-btn createButton" style="width:100%;">
                                            Create Ad
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Current Advertisements</div>
                    <div class="card-body">
                        
                        <table class="table table-bordered">
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
                                @if(count($advs)==0) <h3>No Ads Available</h3> @endif
                                @foreach($advs as $ad)
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
                                        <button class="submit-btn updButton" style="width:100%; height:40%;" data-amount="{{$ad->total}}" data-photo="{{asset('/images/ads')}}/{{$ad->photo}}" data-click="{{$ad->click}}" data-link="{{$ad->link}}" data-toggle="modal" data-stat="{{$ad->status}}" data-name="{{$ad->adtype->name}}"  data-width="{{$ad->adtype->width}}" data-height="{{$ad->adtype->height}}"  data-target="#updateModal" data-act="{{route('user.update-ad', $ad)}}"><i class="fa fa-eye"></i> View</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$advs->links()}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="planModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.create-ad')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="adtype" id="typId"/>
                    <div class="form-group">
                        <label>Redirect URL</label>
                        <input type="text" class="form-control" name="link">
                    </div>
                    <div class="form-group">
                        <label>Ad Type</label>
                        <select class="form-control" name="click">
                            <option value="1">Click</option>
                            <option value="0">Impression</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Estimated Amount of Click/Impression</label>
                        <input type="text" class="form-control" name="amount">
                    </div>
                    <div class="form-group">
                        <h4>Upload <strong id="Width"></strong> x <strong id="Height"></strong> pixel image</h4>
                        <input type="file"  onchange="readURL(this);" class="form-control" name="adfile">
                    </div>
                    <div class="form-group">
                        <img id="uploadedImage"  alt="your image" style="max-width:400px; max-height:400px;"/>
                    </div>
                    <div class="form-group">
                        <label>Advertisement Category</label>
                        <select class="form-control" name="adcategory">
                        @foreach ($adcategories as $adcategory)
                        <option value="{{ $adcategory->id }}">{{ $adcategory->name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                       <label>Enter Sub Category name</label>
                       <input type="text" class="form-control" name="category" required>
                    </div>
                    <div class="form-group">
                       <label>Describe the advert</label>
                       <input type="text" class="form-control" name="description" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="submit-btn" style="width:100%;">Create Ad</button>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
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
                <form id="updateForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Redirect URL</label>
                        <input type="text" class="form-control" id="upLink" name="link">
                    </div>
                    <div class="form-group">
                        <label>Ad Type</label>
                        <select class="form-control" name="click">
                            <option id="clickYes" value="1">Click</option>
                            <option id="clickNo" value="0">Impression</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Estimated Amount of Click/Impression</label>
                        <input type="text" class="form-control" id="TotalAmount" name="amount">
                    </div>
                    <div class="form-group">
                        <h4>Upload <strong id="uWidth"></strong> x <strong id="uHeight"></strong> pixel image</h4>
                        <input type="file"  onchange="readURLu(this);" class="form-control" name="adfile">
                    </div>
                    <div class="form-group well">
                        <img id="uploadedImageu"  alt="your image" style="max-width:400px; max-height:400px;"/>
                    </div>
                    <div class="form-group">
                        <hr/>
                        <h4>Status</h4>
                        <select class="form-control" name="status">
                            <option id="stact" value="1">Active</option>
                            <option id="deact" value="0">Deactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="submit-btn" style="width:100%;">Update Ad</button>
                    </div>
                </form>
                
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
        
        $(document).on('click','.createButton', function(){
            $('#ModalLabel').text($(this).data('name'));
            $('#Width').text($(this).data('width'));
            $('#Height').text($(this).data('height'));
            $('#typId').val($(this).data('type'));
            
            var wd = $(this).data('width');
            var ht = $(this).data('height');
            var plc = "//via.placeholder.com/" + wd +"x"+ ht;
            $('#uploadedImage').attr('src',plc);
        });
        
        $(document).on('click','.updButton', function(){
            $('#ModalTitle').text($(this).data('name'));
            $('#upLink').val($(this).data('link'));
            $('#uWidth').text($(this).data('width'));
            $('#uHeight').text($(this).data('height'));
            $('#TotalAmount').val($(this).data('amount'));
            var rt =  $(this).data('act');
            $('#updateForm').attr('action', rt);
            var uwd = $(this).data('width');
            var uht = $(this).data('height');
            var photo =  $(this).data('photo')
            $('#uploadedImageu').attr('src',photo);
            
            var click = $(this).data('click');
            if(click==1)
            {
                $('#clickyes').attr('selected', true)
            }
            else
            {
                $('#clickNo').attr('selected', true)
            }
            
            var st = $(this).data('stat');
            if(st==1)
            {
                $('#stact').attr('selected', true)
            }
            else
            {
                $('#deact').attr('selected', true)
            }
        });
        
    });
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#uploadedImage')
                .attr('src', e.target.result);
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURLu(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#uploadedImageu')
                .attr('src', e.target.result);
            };
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    
</script>

@endsection



