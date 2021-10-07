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
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:150px;">
                                            @if ($user->photo)
                                                <img src="{{ asset('/images/community').'/'.$user->photo}}" height="150px" width="150px" class="img-fluid">
                                            @endif
                                        </div>
                                        <div>
                                            <span class="btn btn-success btn-file">
                                                <span class="fileinput-new"> Change Photo </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="photo"> 
                                            </span>
                                            <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-element margin-bottom-20">
                                    <label>Profile Description</label>
                                    <textarea class="input-field" name="bio" value="{{$user->bio}}" rows="3" maxlength="200">{{$user->bio}}</textarea>
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
                                    <label>Facebook username</label>
                                    <input class="input-field" type="text" name="facebook" value="{{$user->facebook}}">
                                </div>
                                <div class="form-element margin-bottom-20">
                                    <label>Whatsapp Business link</label>
                                    <input class="input-field" type="text" name="whatsapp" value="{{$user->whatsapp}}">
                                </div>
                                <div class="form-element margin-bottom-20">
                                    <label>Website URL</label>
                                    <input class="input-field" type="text" name="website" value="{{$user->website}}">
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
                    <h5 class="underlined">Your have {{$count}} Posts</h5>
                    <hr>
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                        <div class="card border border-secondary rounded mb-3">
                            <div class="card-header border-0 bg-light">{{$post->heading}}</div>
                            <div class="card-body">
                                <div class="card-text">{{substr($post->details, 0, 100)}}... <a href="{{route('feed.fetch',$post->slug)}}">Read post</a></div>
                            </div>
                            <div class="card-footer d-flex justify-content-start">
                                <span class="mx-4"><i class="fa fa-eye"></i> {{$post->views()->count()}} Views </span>
                                <span class="mx-4"><i class="fa fa-comment"></i> {{$post->comments()->count()}} Comments </span>
                                <form class="ml-auto" action="{{ route('feed.post-delete', $post->id) }}" method="post" class="mr-1">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="activity" value="{{$post->id}}">
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                  </form>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                        {{$posts->links("pagination::bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page_scripts')
<script type="text/javascript" src="{{asset('/js/bootstrap-fileinput.js')}}"></script>

<script type="text/javascript">
    $('textarea').maxlength({
          alwaysShow: true,
          threshold: 10,
          warningClass: "label label-success",
          limitReachedClass: "label label-danger",
          separator: ' out of ',
          preText: 'You write ',
          postText: ' chars.',
          validate: true
    });
</script>
@endsection





