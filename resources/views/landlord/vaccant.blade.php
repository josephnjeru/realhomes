@extends('layouts.app')

@section('content')


<div class="container">
    <div class="card">
        
        <div class="card-body">
            <h4 class="card-title">{{$value->name}}</h4>
            <div class="col-md-6" style="margin-top:10px;">
                <form method="POST" action="{{route('vaccant')}}">  
                                <h3>Total rooms <span class="badge">{{$value->totalrooms}}</span></h3>
                                <h3>Vaccant rooms <span class="badge badge-default">{{$value->availablerooms}}</span></h3>

                                <div class="form-group">
                                    <span>
                                        <p>Enter the number of more vaccant rooms to update</p>
                                        <input class="form-control form-control-sm" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" maxlength="13" name="rooms" required placeholder="More Vaccant rooms">
                                    </span>
                                </div>
                                <div clss="form-group">
                                    <input type="hidden" name="estate" value="{{$value->id}}"/>
                                </div>
                                
                                <button type="submit" class="btn btn-info btn-default" >Update</button>

                            </form>
            </div>
        </div>
    </div>
</div>

@endsection