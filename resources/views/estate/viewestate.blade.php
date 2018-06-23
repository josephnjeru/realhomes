@extends('layouts.app')

@section('content')



 <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row" style="margin-top:10px;">
                        <div class="col-md-6">
                            <div>
                                <div class="card"><img class="img-fluid card-img-top w-100 d-block"  src="<?php echo asset("storage/estates/$estate->image")?>"></div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div></div>
                            <h1>{{$estate->name}}</h1>
                            <div class="form-group d-inline">
                                <p class="lead"><i class="fa fa-map-marker d-inline" style="padding-right:20px; color:rgb(10,133,255);"></i>{{$estate->county.', '.$estate->town.' town, '. $estate->area}}</p>
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
                                    <p class="lead" style="font-size:16px;"><i  class="fa fa-user d-inline" style="padding-right:20px; color:green"></i>{{ $landlord->name }}</p>
                                    <p class="lead" style="font-size:16px;"><i class="fa fa-phone d-inline" style="padding-right:20px; color:green ;"></i>{{ $landlord->phone }}</p>
                                    <p class="lead" style="font-size:16px;"><i class="fa fa-envelope d-inline" style="padding-right:20px; color:green;"></i>{{ $landlord->email }}</p>
                                </div>
                                </div>
                                    {{-- <a href="{{URL::to('checkout/'.$estate->id)}}" class="btn btn-primary btn-block btn-sm" style="color:#ffffff;" type="button" style="margin-right:15px;">Request Book</a> --}}
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Book</button>
                                </div>
                    </div>
                </div>
                <div class="modal fade" id="myModal" role="dialog" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog">
                        
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <img alt="lnm" src="/storage/index.png"> 
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <div class="modal-body" data-keyboard="false" data-backdrop="static">
                            <form method="POST" action="{{route('checkout')}}">
                                <p>Enter your safaricom Mpesa Number to pay. Format (2547xxxxxxxx). </p>
                                <div class="form-group">
                                    <input class="form-control form-control-sm" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" maxlength="13" name="phoneNo" required placeholder="Phone Number">
                                </div>
                                    <h1>
                                        <span class="badge badge-success">
                                            Ksh {{$estate->price}}
                                        </span>
                                    </h1>
                                <div class="form-group">
                                    <input type="hidden" name="estate" value="{{$estate->id}}"/>
                                </div>
                                <button type="submit" class="btn btn-info btn-default" >Confirm payment</button>

                            </form>
                        </div>
                        
                            <div class="modal-footer">
                                <P>Realhomes</P>
                            {{-- <button type="submit" class="btn btn-info btn-default" >Confirm payment</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                            </div>
                        </div>
                        
                        </div>
                    </div>
            </div>
        </div>

@endsection