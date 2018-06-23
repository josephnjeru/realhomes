@extends('layouts.app')

@section('content')

     <div>
        
        <div class="container">
            <div class="form-group">
                 <h1 style="font-size:20px;">Select user account type</h1>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Landlord acount</h4>
                            <p class="card-text">List house for renting</p>
                            <p>Update vaccancy in owned houses</p>
                            <a href="/create-account" class="btn btn-primary btn-sm" type="button" style="background-color:rgb(31,111,136);">Continue</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">User acount</h4>
                            <p class="card-text">Serach, Book and Pay for a house&nbsp;</p>
                            <p>Normal account</p>
                            <a href="/home"  class="btn btn-primary btn-sm" type="button" style="background-color:rgb(53,113,132);">Create my account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection