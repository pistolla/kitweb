@extends('layouts.admin') 
@section('content')
<div class="tile">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Username
                </th>
                <th>
                    Amount
                </th>
                <th>
                    Gateway
                </th>
                <th>
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($deposits as $depo)
            <tr>
                <td>
                    <a href="{{route('admin.user-single', $depo->user_id)}}">{{$depo->user->name}}</a>
                </td>
                <td>
                    {{$depo->amount}} {{$gnl->cur}}
                </td>
                <td>
                    {{$depo->gateway->name}}
                </td>
                <td>
                    <span class="badge {{$depo->status==1 ? 'badge-success' : 'badge-warning'}}">
                    {{$depo->status==1?'Complete':'Pending'}}
                    </span>
                </td>
            </tr>
            @endforeach
            <tbody>
    </table>
    {{$deposits->links()}}
</div>

@endsection