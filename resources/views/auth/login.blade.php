@extends('layouts.app')

@section('content')
                <div class=" login">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h2 class="sr-only">Login Form</h2>

                        <div class="illustration"><i class="icon ion-log-in"></i></div>

                        <div class="form-group">
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" type="email" name="email" placeholder="Email">
                            
                             @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                         <div class="form-group">
                             <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" required="" placeholder="Password">
                             
                              @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                         </div>

                        <div class="form-group">
                            <div class="form-check"><input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} ><label class="form-check-label" for="formCheck-tenant">{{ __('Remember me')}}</label></div>
                        </div>
                        <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>


                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
@endsection
