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
                    Method
                </th>
                <th>
                    Amount
                </th>
                <th>
                    Account
                </th>         	
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>
                    <a href="{{route('admin.publisher-single', $log->publisher_id)}}">{{$log->publisher->name}}</a>
                </td>
                <td>
                        {{$log->wmethod->name}}      
                        
                    </td>
                <td>
                    {{$log->amount}} {{$gnl->cur}}      
                </td> 
                <td>
                    {{$log->account}}      
                    
                </td>
            </tr>
            @endforeach 
            <tbody>
            </table>
            {{$logs->links()}}
        </div>
        
    </div>
@endsection
    