@extends('layouts.app')

@section('content')

        <div class="container">
            @include('search.search')
            <div class="row">
                @foreach($estates as $key=>$value)
                <div class="col-md-3">
                    <div class="card" style="margin-top:20px"><img class="card-img-top w-100 d-block" src="<?php echo asset("storage/estates/$value->image")?>">
                        <div class="card-body">
                            <a href="{{ URL::to('view-estate/'.$value->id)  }}"><h4 class="card-title">{{ $value->name }}</h4></a>
                            <p>{{$value->county.', '.$value->town.' town, '. $value->area}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>

@endsection