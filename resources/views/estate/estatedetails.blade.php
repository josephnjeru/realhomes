@extends('layouts.app')

@section('content')

 <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-top:50px;">
                        <div class="col-4 col-md-6">
                            <div>
                                <div class="card"><img class="img-fluid card-img-top w-100 d-block"  src="<?php echo asset("storage/estates/$estate->image")?>"></div>
                            </div>
                        </div>
                        <div class="col-4 col-md-6 offset-0">
                            <div></div>
                            <h1>{{$estate->name}}</h1>
                            <div class="form-group d-inline">
                                <p class="lead"><i class="fa fa-map-marker d-inline" style="padding-right:20px;"></i>{{$estate->county.', '.$estate->town.' town, '. $estate->area}}</p>
                            </div>
                            <p style="padding-left:15px;">{{$estate->more_info}}</p>

                            <div class="form-group">
                                <p><label>Rent: &nbsp;</label>Ksh {{$estate->price}}</p>
                                <p><label>Total rooms:&nbsp;</label>{{$estate->totalrooms}}</p>
                                <p><label>Available rooms:&nbsp;</label>{{$estate->availablerooms}}</p>
                            </div>

                            <div class="card" style="margin-bottom:10px;">
                                <div class="card-header" style="background-color:rgba(0,0,0,0);">
                                    <h5 class="mb-0">Landlord contacts</h5>
                                </div>
                                <div class="card-body">
                                    <p class="lead" style="font-size:16px;"><i class="fa fa-user d-inline" style="padding-right:20px;"></i>{{ $landlord->name }}</p>
                                    <p class="lead" style="font-size:16px;"><i class="fa fa-phone d-inline" style="padding-right:20px;"></i>{{ $landlord->phone }}</p>
                                    <p class="lead" style="font-size:16px;"><i class="fa fa-envelope-o d-inline" style="padding-right:20px;"></i>{{ $landlord->email }}</p>
                                </div>
                                </div>
                                    <a href="{{URL::to('edit/' .$estate->id)}}" class="btn btn-primary btn-sm" type="button" style="margin-right:15px;">Edit details</a>
                                    <button class="btn btn-outline-primary btn-sm" type="button">Close</button>
                                </div>
                    </div>
                </div>
            </div>
        </div>

@endsection