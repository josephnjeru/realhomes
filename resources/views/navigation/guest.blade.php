    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean">
            <div class="container"><a class="navbar-brand" href="#">{{ config('app.name', 'RealHomes') }}</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link " href="{{ route('login')}}">{{__('Login')}}</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link " href="{{ route('register') }}">{{__('Register')}}</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>