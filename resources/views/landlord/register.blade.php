@extends('layouts.app')

@section('content')

 <div class="register">
        <div class="form-container">
            <form method="post" action='api/landlord'>
                <h2 class="text-center"><strong>Create</strong> Landlord account.</h2>
                <div class="form-group"><input class="form-control" type="text" name="name" required="" placeholder="Full Names" autocomplete="off"></div>
                <div class="form-group"><input class="form-control" type="text" name="idnumber" required="" placeholder="Id Number" maxlength="10" autocomplete="off" inputmode="numeric"></div>
                <div class="form-group"><input class="form-control" type="tel" name="phone" required="" placeholder="Phone Number" maxlength="12" minlength="10" autocomplete="off" inputmode="numeric"></div>
                <div class="form-group"><input class="form-control" type="text" name="county" required="" placeholder="County"></div>
                <div class="form-group"><input class="form-control" type="text" name="town" required="" placeholder="Town"></div>
                <div class="form-group"><input class="form-control" type="text" name="area" placeholder="Area"></div>
                <div class="form-group">
                    <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox">I agree to the license terms.</label></div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Continue</button>
                </div>
            </form>
        </div>
    </div>

@endsection