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
                            <form class="contact-form"  method="POST" action="{{ route('publisher.update-profile') }}">
                                @csrf
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
                            <form class="contact-form" method="POST" action="{{ route('publisher.change-passwordpost') }}">
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
                                <span class="mx-4"><i class="fa fa-eye"></i> Views {{$post->getViews()}}</span>
                                <span class="mx-4"><i class="fa fa-share"></i> Shares {{$post->getShares()}}</span>
                                <span class="mx-4"><i class="fa fa-comment"></i> Comments {{$post->getComments()}}</span>
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





