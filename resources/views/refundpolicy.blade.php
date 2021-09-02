@extends('layouts.user')

@section('content')
<section class="breadcrumb-area breadcrumb-bg white-bg">
    <div class="container">
    <div class='MainAdverTiseMentDiv' data-publisher="1" data-adsize="970x250"></div>
    </div>
</section>
<div class="blog-page-conent">
    <div class="container">
        <div class="row">
              {!! $doc->refundpolicy !!}
        </div>
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
    </div>
</div>
@endsection