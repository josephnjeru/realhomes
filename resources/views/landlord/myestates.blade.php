@extends('layouts.app')

@section('content')
<div class="container">
    <div class="">
        <h2 class="text-center"> List of my Estates</h2>
        <div class="form-group">
                    <a href="/create" class="btn btn-outline-success btn-block" type="submit">Create new</a>
                </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Landlord</th>
                    <th>Total rooms</th>
                    <th>Available rooms</th>
                    <th>County</th>
                    <th>Town</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estates as $key=>$value)
                <tr>
                    <td>{{$value->name}}</td>
                    <td>{{$value->landlord}}</td>
                    <td>{{$value->totalrooms}}</td>
                    <td>{{$value->availablerooms}}</td>
                    <td>{{$value->county}}</td>
                    <td>{{$value->town}}</td>

                    <td>
                        @if($value->status == null)
                        <span class="badge badge-primary">Waiting</span>
                        @else
                        <span class="badge badge-success">Active</span>
                        @endif
                    </td>
                    <td>
                        @if($value->status !== null)
                        <a class="btn btn-outline-danger btn-sm" href="{{URL::to('deactivate/'.$value->id)}}">Deactivate</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{URL::to('update_vaccant/'.$value->id)}}" class="btn btn-outline-success btn-sm"   >Add vaccant rooms</a>
                    </td>
                </tr>
                
                @endforeach

                <tr></tr>
                
            </tbody>
        </table>
        <div>
</di>
@endsection