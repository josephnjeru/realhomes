@extends('layouts.app')

@section('content')

            <div class="card col-md-6 offset-md-3">
                <div class="card-body">
                    
                        
                        
                        <h4 class="card-title">Edit home details</h4>
                        <div class="">
                            
                            <form method="POST" enctype="multipart/form-data" action="{{route('update')}}">
                                <h4 class="text-left"><strong>Home details</strong></h4>
                                <div class="form-group"><input class="form-control form-control-sm" type="text" name="name" required="" value="{{$estate_old->name}}" placeholder="Property Name" autocomplete="off"></div>
                                <div class="form-group"><select class="form-control form-control-sm" name="type"><optgroup label="This is a group"><option value="rental" selected="">Rental apartment</option><option value="hostel">Hostel</option><option value="bedsitter">Bedsitter</option><option value="motel">Motel</option></optgroup></select></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="text" name="county" value="{{$estate_old->county}}" required="" placeholder="County" autocomplete="off"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="tel" name="town" value="{{$estate_old->town}}" required="" placeholder="Town" autocomplete="off"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="text" name="area" value="{{$estate_old->area}}" required="" placeholder="Area"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="text" name="more_info" value="{{$estate_old->more_info}}" required="" placeholder="More Details"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="number" name="totalrooms" value="{{$estate_old->totalrooms}}" required="" placeholder="Total rooms"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="number" name="vaccant" value="{{$estate_old->availablerooms}}" required="" placeholder="Vaccant rooms"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="number" name="price" required="" value="{{$estate_old->price}}" placeholder="Price (ksh)"></div>
                                <input value=""  type="file" accept="image/*" name="image">
                                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save details</button></div>
                            </form>
                    </div>
                </div>
            </div>
        </div>


@endsection