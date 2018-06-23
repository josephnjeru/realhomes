@extends('admin.admin')

@section('content')

<div class="container">
    <div class="card">
        <h2 class="text-center">Landlords Records</h2> 
        
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>County</th>
                    <th>Town</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($landlords as $key=>$value)
                <tr>
                    <td>{{$value->name}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->phone}}</td>
                    <td>{{$value->county}}</td>
                    <td>{{$value->town}}</td>

                    <td>
                        @if($value->status == null)
                        <a class="btn btn-outline-primary btn-sm" href="{{URL::to('admin/activate/'.$value->id)}}">Activate</a>
                        @else
                        <span class="badge badge-success">Active</span>
                        @endif
                    </td>
                    <td>
                        @if($value->status !== null)
                        <a class="btn btn-outline-danger btn-sm" href="{{URL::to('admin/deactivate/'.$value->id)}}">Deactivate</a>
                        @endif
                    </td>
                </tr>
                @endforeach

                <tr></tr>
            </tbody>
        </table>
        <div>
</di>

@endsection

