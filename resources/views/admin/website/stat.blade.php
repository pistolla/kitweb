@extends('layouts.admin')
@section('right_action')
<button class="btn btn-md btn-primary" data-toggle="modal" data-target="#newSlider">
    <i class="fa fa-plus"></i> New Testimonial
</button>
@endsection
@section('content')
<div class="tile">
    <div class="row">
        <div class="col-md-12">
            <form action="{{route('admin.stat-section')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <h4>Section Heading</h4>
                    <textarea class="form-control" name="heading">{{$front->stat_heading}}</textarea>
                </div>
                <div class="form-group">
                        <h4>Section Details</h4>
                    <textarea class="form-control" name="details">{{$front->stat_details}}</textarea>
                </div>	
                <div class="card card-body mt-2">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h4>1st Box Amount</h4>
                                <input type="text" value="{{$front->stat1}}" class="form-control"  name="stat1" >
                            </div>	
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h4>1st Box Subscript</h4>
                                <input type="text" value="{{$front->stat2}}" class="form-control"  name="stat2" >
                            </div>	
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h4>1st Box Details</h4>
                                <input type="text" value="{{$front->stat3}}" class="form-control"  name="stat3" >
                            </div>	
                        </div>
                    </div>
                </div>
                <div class="card card-body mt-2">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h4>2nd Box Amount</h4>
                                <input type="text" value="{{$front->stat4}}" class="form-control"  name="stat4" >
                            </div>	
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h4>2nd Box Subscript</h4>
                                <input type="text" value="{{$front->stat5}}" class="form-control"  name="stat5" >
                            </div>	
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h4>2nd Box Details</h4>
                                <input type="text" value="{{$front->stat6}}" class="form-control"  name="stat6" >
                            </div>	
                        </div>
                    </div>
                </div>
                <div class="card card-body mt-2">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h4>3rd Box Amount</h4>
                                <input type="text" value="{{$front->stat7}}" class="form-control"  name="stat7" >
                            </div>	
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h4>3rd Box Subscript</h4>
                                <input type="text" value="{{$front->stat8}}" class="form-control"  name="stat8" >
                            </div>	
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h4>3rd Box Details</h4>
                                <input type="text" value="{{$front->stat9}}" class="form-control"  name="stat9" >
                            </div>	
                        </div>
                    </div>
                </div>
                
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success btn-block">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection