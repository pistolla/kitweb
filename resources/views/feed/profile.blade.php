@extends('layouts.user')

@section('content')

<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner">
                    <h1 class="title">{{$pt}}</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-page-area">
    <div class="container contact-page-container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-page-inner">
                    <div class="card">
                        <div class="card-header">Profile Information</div>
                        <div class="card-body">
                            <form class="contact-form"  method="POST" action="{{ route('feed.update-profile') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group card card-body">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:150px;"> </div>
                                        <div>
                                            <span class="btn btn-success btn-file">
                                                <span class="fileinput-new"> Change Photo </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="photo"
                                                    @if ($user->photo)
                                                       src="{{url('/').'/images/community/'.$user->photo}}" 
                                                    @endif
                                                > 
                                            </span>
                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-element margin-bottom-20">
                                    <label>Name</label>
                                    <input class="input-field" type="text" name="name" value="{{$user->name}}" required>
                                </div>
                                <div class="form-element margin-bottom-20">
                                    <label>Email</label>
                                    <input class="input-field" type="email" name="email" value="{{$user->email}}" required>
                                </div>
                                <div class="form-element margin-bottom-20">
                                    <label>Mobile</label>
                                    <input class="input-field" type="text" name="mobile" value="{{$user->mobile}}" required>
                                </div>
                                <div class="form-element margin-bottom-20">
                                    <label>Country</label>
                                    <input class="input-field" type="text" name="country" value="{{$user->country}}" required>
                                </div>
                                <div class="form-element margin-bottom-20">
                                    <label>State/County/Province</label>
                                    <input class="input-field" type="text" name="city" value="{{$user->city}}" required>
                                </div>
                                <div class="form-element margin-bottom-20">
                                    <label>City/Town</label>
                                    <input class="input-field" type="text" name="city" value="{{$user->city}}" required>
                                </div>
                                <div class="form-element margin-bottom-20">
                                    <button type="submit" class="submit-btn" style="width:100%">
                                        Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr class="mt-4 mb-2">
                    <div class="card">
                        <div class="card-header">Password</div>
                        <div class="card-body">
                            <form class="contact-form" method="POST" action="{{ route('feed.change-passwordpost') }}">
                                @csrf
                                <div class="form-element margin-bottom-20">
                                    <input class="input-field" id="password" type="password" placeholder="Enter New Password" name="password" required>
                                </div>
                                
                                <div class="form-element margin-bottom-20">
                                    <input class="input-field" id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                                </div>
                                
                                <div class="form-element margin-bottom-20">
                                    <button type="submit" class="submit-btn" style="width:100%">
                                        Change Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-page-inner">
                    @if ($posts != null)
                        @foreach ($posts as $post)
                        <div class="card border-0">
                            <div class="card-header">{{$post->heading}}</div>
                            <div class="card-body">
                                <div class="card-text">{{substring($post->details, 0, 100)}}... <a href="{{route('feed.post',$post->slug)}}">Read post</a></div>
                            </div>
                            <div class="card-footer d-flex justify-content-start">
                                <span class="mx-4"><i class="fa fa-eye"></i> {{$post->getViews()->count()}} Views </span>
                                <span class="mx-4"><i class="fa fa-comment"></i> {{$post->getComments()->count()}} Comments </span>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page_scripts')
<script src="{{asset('/js/bootstrap-fileinput.js')}}"></script>

<script>
    
    $(document).ready(function(){
        $(document).on('click','.updateButton', function(){
            $('#ModalLabel').text($(this).data('heading'));
            $('#name').val($(this).data('name'));
            $('#heading').val($(this).data('heading'));
            $('#details').val($(this).data('details'));
            let id = $(this).data('item');
            let photo = $(this).data('photo');
            let route = "{{url('/')}}"+'/admin/testimonial-update/'+ id;
            $('#updForm').attr('action',route);
            $('#photo').attr('src',photo);
        });
    });
    
    
</script>
@endsection





