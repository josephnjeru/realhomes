@extends('layouts.app')

@section('content')
<div class="container" >
    

                <div class="register">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <h2 class="text-center"><strong>Register</strong></h2>

                        <div class="form-group">
                            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" type="text" placeholder="Name">
                                
                                 @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" type="email" name="email" placeholder="Email">
                                
                                 @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div>
                            <select name="role" class="form-control" >
                                <option value="customer">User</option>
                                <option value="landlord">Landlord</option>
                            </select> 
                        </div>

                         <div class="form-group"><input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password">
                         
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                         </div>
     
                        <div class="form-group">
                            <input id="password-comfirm" class="form-control" type="password" name="password_confirmation" placeholder="Password (repeat)">
                            
                            
                            </div>

                                <div class="form-group">
                                    <div class="form-check"><input class="form-check-input" name="landlord" type="checkbox" id="landlord"><label class="form-check-label" for="landlord">Landlord</label></div>
                                </div>
                                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Sign Up</button></div><a href="login.html" class="already">You already have an account? Login here.</a></form>
                            </div>
                        

               
                    </form>
                </div>
         
</div>
@endsection
