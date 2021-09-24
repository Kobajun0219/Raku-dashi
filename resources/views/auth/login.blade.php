@extends('layouts.app')

@section('content')
<style>
.button { 
  color: #EEEEE;
  font-size: 15px;
  background-color: #00C300;  
}

.button:hover {
  color: #EEEEE;
  background-color: #00E000
}

.button:active {
  background-color: #00B300
}
</style>

    <!-- ログアウト後に表示-->
    @include('common.com')
    <!-- ログアウト後に表示-->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color:#FCE38A;">{{ __('Login') }}</div>
                <div class="card-body">
                    <div>全ての機能を利用するには会員登録が必要です</div>
                    <div class="pt-2 text-center">
                        <button type="submit" class="btn" style="background-color:#FCE38A;">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register with mail') }}</a>
                        </button>
                        <button type="submit" class="btn mt-2" style="background-color:#06C755;">
                        <a href="{{ route('line.login') }}" style="color: white;"><img src="{{url('image/btn_base.png')}}" style="height:39px;" class="pr-3">{{ __('Register with Line') }}</a>
                        </button>
                        <!--<a href="login/facebook">facebookでログイン</a>-->
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" style="background-color:#FCE38A;">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mx-auto">もしくは</div>
                <a href="{{ route('line.login') }}" class="mx-auto m-2" style="height:50px;"><img src="{{url('image/btn_login_base.png')}}" style="height:100%;"></a>
            </div>
        </div>
    </div>
</div>

@endsection


