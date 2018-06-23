@extends('layouts.app')

@section('content')

            <div class="container">
            <div class="card">
                <div class="card-body">
                    
                        <div class="form-group"><a href="/my-estates" class="btn btn-outline-primary btn-sm" >view my homes</a></div>
                        
                        <h4 class="card-title">Add new home to listing</h4>
                        <div class="col-md-6">
                            
                            <form method="post" enctype="multipart/form-data" action="api/estate">
                                <h4 class="text-left"><strong>Home details</strong></h4>
                                <div class="form-group"><input class="form-control form-control-sm" type="text" name="name" required="" placeholder="Property Name" autocomplete="off"></div>
                                <div class="form-group"><select class="form-control form-control-sm" name="type"><optgroup label="This is a group"><option value="rental" selected="">Rental apartment</option><option value="hostel">Hostel</option><option value="bedsitter">Bedsitter</option><option value="motel">Motel</option></optgroup></select></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="text" name="county" required="" placeholder="County" autocomplete="off"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="tel" name="town" required="" placeholder="Town" autocomplete="off"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="text" name="area" required="" placeholder="Area"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="text" name="more_info" required="" placeholder="More Details"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="number" name="totalrooms" required="" placeholder="Total rooms"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="number" name="vaccant" required="" placeholder="Vaccant rooms"></div>
                                <div class="form-group"><input class="form-control form-control-sm" type="number" name="price" required="" placeholder="Price (ksh)"></div>
                                <input  type="file" accept="image/*" name="image">
                                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Create</button></div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection