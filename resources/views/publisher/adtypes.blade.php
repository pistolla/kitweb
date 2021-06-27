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
<section class="testimonial-page-conent">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div style="overflow-x:auto;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ad Name</th>
                                <th>Ad Type</th>
                                <th>Ad Width</th>
                                <th>Ad Height</th>
                                <th>Script</th>
                                <th>Copy Script</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($types as $type)
                            <tr>
                                <td>{{$type->name}}</td>
                                <td>{{$type->type}}</td>
                                <td>{{$type->width}} pixel</td>
                                <td>{{$type->height}} pixel</td>
                                <td>
                                    <textarea id="advertScript{{$type->id}}" class="form-control" rows="2" readonly><div class='MainAdverTiseMentDiv' data-publisher="{{$pubid}}" data-adsize="{{$type->slag}}"></div> <script class="adScriptClass" src="{{url('/')}}//ads/ad.js"></script></textarea>
                                </td>
                                <td>
                                    <button class="submit-btn copyButton" style="width:100%" data-copyelement="advertScript{{$type->id}}">
                                        Copy Script
                                    </button>
                                </td>
                                
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page_scripts')

<script type="text/javascript">
    jQuery(document).on('ready', function() {
        $(document).on('click', '.copyButton', function(e){
            e.preventDefault();
            var copyBtnID = $(this).data('copyelement');
            document.getElementById(copyBtnID).select();
            document.execCommand('copy');
        });
    });
</script>

@endsection



